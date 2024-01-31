<?php

namespace App\Http\Services\User;

use App\Models\User;
use Cryptommer\Smsir\Smsir;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OTPService
{
    /**
     * Check user can request again OTP code
     *
     * @param User $user
     * @return bool
     */
    public function allowRequestOTP(User $user): bool
    {
        $lastOTP = $user->otps()->latest()->first();

        // Doesn't send request yet.
        if (! $lastOTP) return true;

        return $lastOTP->created_at->addSeconds(config('auth.otp_lifetime_seconds'))->isPast();
    }

    /**
     * Create new OTP
     *
     * @param User $user
     * @param array $info
     * @return HasMany
     */
    public function createNew(User $user, array $info): HasMany
    {
        // generate OTP code
        $code = rand(11111, 99999);
        $token = Str::random(60);

        $user->otps()->create(array_merge([
            'code'  => $code,
            'token' => $token
        ], $info));

        return $user->otps()->where('code', $code);
    }


    /**
     * Validate OTP code
     *
     * @param User $user
     * @param string $code
     * @param bool $markAsExpired
     * @return bool
     */
    public function isValid(User $user, string $code, bool $markAsExpired = true): bool
    {
        $otp = $user->otps()->where('code', $code)->first();

        // Check if OTP doesn't exists return false
        if (! $otp) return false;

        // check if OTP marked as expired return false
        if ($otp->used_at) return false;;

        // Check if OTP time expired return false
        if ($otp->created_at->addSeconds(config('auth.otp_lifetime_seconds'))->isPast()) return false;

        if ($markAsExpired) $otp->update(['used_at' => now()]);

        return true;
    }

    public function sendOTP($code, $to, $pattern = 111251)
    {
        $smsir = Smsir::Send();
        $parameter = new \Cryptommer\Smsir\Objects\Parameters('code', $code);
        $parameters = array($parameter);
        $smsir->Verify($to, $pattern, $parameters);
    }
}
