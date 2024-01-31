<x-home.layout>
    <x-slot:title>ورود | ثبت نام</x-slot:title>
    <x-slot:url>https://gpgaming.ir/</x-slot:url>
    <x-slot:name>گیم پردایس</x-slot:name>

    <div class="tf-section-2 pt-60 widget-box-icon" dir="rtl">
        <div class="themesflat-container w920">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section-1">
                        <h2 class="tf-title pb-16" style="perspective: 400px;">
                            <div style="display: block; text-align: center; position: relative; transform-origin: 460px 27.5px; transform: translate3d(0px, 0px, 0px); opacity: 1;">ورود | ثبت نام</div>
                        </h2>
                        <p class="pb-40">به بهشت بازی ما خوش آمدید. با وارد کردن چند مورد، از بازی کردن نهایت لذت رو ببرید.</p>
                    </div>
                </div>
                <div class="col-sm-11 col-md-6 mx-auto">

                    <x-home.flash-message/>


                    <div class="widget-login">
                        <form method="POST" action="{{ route('auth.authenticate') }}" class="comment-form">
                            @csrf

                            <fieldset class="id">
                                <label for="id">شماره موبایل *</label>
                                <input type="text" id="id" placeholder="09** *** ****" name="id" dir="ltr" value="{{ old('id') }}">
                            </fieldset>

                            <div class="btn-submit mb-30">
                                <button class="tf-button blue-btn style-1 h50 w-100" type="submit">ورود | ثبت نام<i class="icon-arrow-up-right2"></i></button>
                            </div>
                        </form>
                        <div class="other">یا</div>
                        {{--                        <div class="login-other">--}}
                        {{--                            <a href="{{ route('login') }}" class="login-other-item">--}}
                        {{--                                <span>ایمیل و کلمه عبور</span>--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                        <div class="login-other">
                            <a href="#" class="login-other-item disable">
                                <img src="{{ asset('assets/images/google.png') }}" alt="">
                                <span>با گوگل وارد شوید</span>
                            </a>
                        </div>

                        <div class="text-center pb-0 sub-text">
                            <a href="{{ route('home') }}" class="text-decoration-none text-primary">بازگشت به خانه</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-home.layout>