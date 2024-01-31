<form {{ $attributes->class(['comment-form']) }}>
    <div class="flex justify-between">
        <fieldset class="name">
            <input type="text" id="name" disabled placeholder="نام و نام خانوادگی*" class="style-1 border-gray" name="name" tabindex="2" aria-required="true" required="">
        </fieldset>
        <fieldset class="email">
            <input type="email" id="email" disabled placeholder="ایمیل*" class="style-1 border-gray" name="email" tabindex="2" aria-required="true" required>
        </fieldset>
    </div>
    <fieldset class="message">
        <textarea id="message" name="message" rows="4" disabled placeholder="دیدگاه شما*" class="style-1 border-gray m-0" tabindex="4" aria-required="true" required></textarea>
    </fieldset>
    <div class="alert alert-info text">
                                        <span>گیمر عزیز، برای اینکه نظر خودت رو وارد کنی، اول باید تو سایت
                                            <a class="text-primary" wire:navigate.hover href="{{ route('auth.authentication-form') }}">ورود | ثبت نام</a> کنی </span>
    </div>
</form>