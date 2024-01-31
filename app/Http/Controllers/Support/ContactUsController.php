<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Http\Requests\Support\StoreContactUsRequest;
use App\Models\Support\ContactUs;
use App\Models\User;
use App\Nova\Support\ContactUsNovaResource;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('home.support.contact-us');
    }

    public function store(StoreContactUsRequest $request)
    {
        $contactUs = ContactUs::query()->create($request->validated());

        $message = ' کاربر با ایمیل ' . $contactUs->email . ' یک پیام از طریق فرم تماس با ما فرستاده است. ';
        $adminUsers = User::query()->admin()->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(
                NovaNotification::make()
                    ->message($message)
                    ->action('نمایش', URL::remote(url(sprintf('nova/resources/%s/%d', ContactUsNovaResource::uriKey(), $contactUs->id))))
                    ->icon('check-circle')
                    ->type('info')
            );
        }

        alert()->success('تماس شما با موفقیت فرستاده شد.', 'صندوق ایمیل خود را برای دریافت پاسخ بررسی کنید');
        return to_route('home');

    }
}
