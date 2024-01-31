<?php

namespace Modules\User\Services;

use App\Support\Traits\JsonResponseHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Modules\User\Entities\User;
use Modules\User\Enums\OTPTarget;
use Modules\User\Enums\OTPType;
use Modules\User\Enums\UserRole;
use Modules\User\Http\Requests\LoginWithPasswordRequest;
use Modules\User\Http\Requests\RecoverQueryRequest;
use Modules\User\Http\Requests\SendOTPRequest;
use Modules\User\Http\Requests\SendRecoverCodeRequest;
use Modules\User\Http\Requests\VerifyOTPRequest;
use Modules\User\Http\Requests\VerifyRecoveryCodeRequest;
use Modules\User\Jobs\SendOTPJob;
use Modules\User\Transformers\UserResource;

class AuthService
{
    use JsonResponseHandler;

    /**
     * Send OTP code to A mobile number
     *
     * @param SendOTPRequest $request
     * @return JsonResponse
     */
    public function sendOTP(SendOTPRequest $request): JsonResponse
    {
        $user = User::firstOrCreate(['mobile' => $request->input('mobile')]);

        // Check user allow to receive new OTP code
        if (! $user->wasRecentlyCreated && ! app(OTPService::class)->allowRequestOTP($user)) {
            return $this->tooManyRequest();
        }

        if ($request->boolean('signup_as_company')) {
            if (! app(UserService::class)->canSignUpAsCompany($user)) {
                return $this->forbidden(trans('Access denied to signup as company!'));
            }
            $user->update(['role' => UserRole::COMPANY]);
        }

        // Send Login OTP code to user
        SendOTPJob::dispatch($user, [
            'type'  => OTPType::LOGIN,
            'ip'    => $request->ip(),
            'agent' => $request->userAgent(),
        ]);

        return $this->success();
    }

    /**
     * Verify OTP code
     *
     * @param VerifyOTPRequest $request
     * @return JsonResponse
     */
    public function verifyOTP(VerifyOTPRequest $request): JsonResponse
    {
        $user = User::where('mobile', $request->input('mobile'))->firstOrFail();
        $isValidOTP = app(OTPService::class)->isValid(
            user: $user,
            code: $request->input('code')
        );

        if (! $isValidOTP) {
            return $this->forbidden(trans('OTP incorrect or invalid.'));
        }

        app(UserService::class)->markAsVerified($user);

        return $this->success([
            'user'  => new UserResource($user),
            'token' => app(TokenService::class)->createNew($user, $request->userAgent())
        ]);
    }

    /**
     * Login companies with password
     *
     * @param LoginWithPasswordRequest $request
     * @return JsonResponse
     */
    public function loginWithPassword(LoginWithPasswordRequest $request): JsonResponse
    {
        $contactLine = $request->input('contact_line');
        $credentials = $request->only('password');
        $credentials[Str::isEmail($contactLine) ? 'email' : 'mobile'] = $contactLine;
        $credentials['role'] = function (Builder $builder) {
            $builder->whereIn("role", [UserRole::COMPANY, UserRole::ADMIN]);
        };

        if (! Auth::attempt($credentials)) {
            return $this->unauthorized(trans('Credentials incorrect.'));
        }

        $user = Auth::user();

        return $this->success([
            'user'  => new UserResource($user),
            'token' => app(TokenService::class)->createNew($user, $request->userAgent())
        ]);
    }

    /**
     * Recovery query
     *
     * @param RecoverQueryRequest $request
     * @return JsonResponse
     */
    public function recoveryQuery(RecoverQueryRequest $request): JsonResponse
    {
        $company = app(UserService::class)->findCompanyByContactLine($request->input('contact_line'));

        if (! $company) {
            return $this->notFound(trans("Company doesn't exists."));
        }

        $contact = [
            "mobile" => Str::preview($company->mobile),
            "email"  => Str::previewEmail($company->email),
        ];

        return $this->success(compact('contact'));
    }

    /**
     * Send recovery code for company
     *
     * @param SendRecoverCodeRequest $request
     * @return JsonResponse
     */
    public function sendRecoveryCode(SendRecoverCodeRequest $request): JsonResponse
    {
        $company = app(UserService::class)->findCompanyByContactLine($request->input('contact_line'));

        if (! $company) {
            return $this->notFound(trans("Company doesn't exists."));
        }

        // Check user allow to receive new OTP code
        if (! app(OTPService::class)->allowRequestOTP($company, OTPType::RECOVERY)) {
            return $this->tooManyRequest();
        }

        // Send Recovery OTP code to user
        $metaData = [
            'type'  => OTPType::RECOVERY,
            'ip'    => $request->ip(),
            'agent' => $request->userAgent(),
        ];
        $receiverTarget = OTPTarget::tryFrom($request->input('target'));
        SendOTPJob::dispatch($company, $metaData, [$receiverTarget]);

        return $this->success();
    }

    /**
     * Check recovery OTP code
     *
     * @param VerifyRecoveryCodeRequest $request
     * @return JsonResponse
     */
    public function checkRecoveryCode(VerifyRecoveryCodeRequest $request): JsonResponse
    {
        $company = app(UserService::class)->findCompanyByContactLine($request->input('contact_line'));

        $isValidOTP = app(OTPService::class)->isValid(
            user: $company,
            code: $request->input('code'),
            type: OTPType::RECOVERY
        );

        if (! $isValidOTP) {
            return $this->forbidden(trans('OTP incorrect or invalid.'));
        }

        # Revoke all tokens from all devices before generate new token
        app(TokenService::class)->revokeAll($company);

        return $this->success([
            'token' => app(TokenService::class)->createNew($company, $request->userAgent())
        ]);
    }

    public function SSOLogin(Request $request): RedirectResponse
    {
        $request->session()->put('state', $state = Str::random(40));
        $query = http_build_query([
            'client_id'     => config("sso.client_id"),
            'redirect_uri'  => route("auth.sso.callback"),
            'response_type' => 'code',
            'scope'         => 'profile',
            'state'         => $state,
        ]);

        return redirect()->away(sprintf('%s?%s', config("sso.authorize_url"), $query));
    }

    public function SSOCallback(Request $request): RedirectResponse
    {
        $state = $request->session()->pull('state');
        throw_unless(strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        $response = Http::asForm()->post(config('sso.request_auth_token_url'), [
            'grant_type'    => 'authorization_code',
            'client_id'     => config("sso.client_id"),
            'client_secret' => config("sso.client_secret"),
            'redirect_uri'  => route("auth.sso.callback"),
            'code'          => $request->code,
            'scope'         => 'openid profile',
        ]);

        $res = $response->json();
        $jwt = $res['access_token'];
        $headers = ['Authorization' => 'Bearer ' . $jwt];
        $infoRequest = Http::withHeaders($headers)
            ->timeout(10)
            ->connectTimeout(10)
            ->get(config('sso.request_user_info_url'));

        $infoResponse = json_decode($infoRequest->body(), true, flags: JSON_UNESCAPED_UNICODE);

        if (! $infoResponse['isSuccess']) {
            return redirect()->away(config('sso.failed_callback_url'));
        }

        $user = User::firstOrCreate(['mobile' => $infoResponse['data']['mobile']], [
            'role'        => UserRole::USER,
            'verified_at' => now(),
        ]);
        if ($user->wasRecentlyCreated) {
            $user->userInformation()->create([
                'first_name' => $infoResponse['data']['firstName'],
                'last_name'  => $infoResponse['data']['lastName'],
                'nid'        => $infoResponse['data']['nationalId'],
                'birth_day'  => $infoResponse['data']['birthDateShamsi']
            ]);
        }

        $token = app(TokenService::class)->createNew($user, $request->userAgent());
        return redirect()->away(sprintf("%s?token=%s", config('sso.success_callback_url'), $token));
    }

}
