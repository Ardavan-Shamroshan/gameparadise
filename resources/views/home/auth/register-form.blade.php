<x-home.layout>
    <div class="tf-section-2 pt-60 widget-box-icon" dir="rtl">
        <div class="themesflat-container w920">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section-1">
                        <h2 class="tf-title pb-16" style="perspective: 400px;">
                            <div style="display: block; text-align: center; position: relative; transform-origin: 460px 27.5px; transform: translate3d(0px, 0px, 0px); opacity: 1;">حساب کاربری خود را تکمیل کنید</div>
                        </h2>
                        <p class="pb-40">به بهشت بازی ما خوش آمدید. با وارد کردن چند مورد، از بازی کردن نهایت لذت رو ببرید.</p>
                    </div>
                </div>
                <div class="col-sm-11 col-md-6 mx-auto">

                    <x-home.flash-message/>

                    <div class="widget-login">
                        <form method="POST" action="{{ route('auth.register', $user) }}" class="comment-form">
                            @csrf

                            <fieldset class="name">
                                <label for="name">نام*</label>
                                <input type="text" id="name" placeholder="نام و نام خانوادگی" class="@error('name') error border-danger @enderror" name="name" value="{{ old('name') }}">
                            </fieldset>

                            <fieldset class="email">
                                <label for="email">ایمیل*</label>
                                <input type="email" id="email" placeholder="ایمیل" class="@error('email') error border-danger @enderror" name="email" value="{{ old('email') }}">
                            </fieldset>

                            <fieldset class="national_code">
                                <label for="national_code">کد ملی*</label>
                                <input type="number" id="national_code" placeholder="کد ملی" class="@error('national_code') error border-danger @enderror" name="national_code" value="{{ old('national_code') }}">
                            </fieldset>

                            <div class="btn-submit mb-30">
                                <button class="tf-button blue-btn style-1 h50 w-100" type="submit">ثبت اطلاعات<i class="icon-arrow-up-right2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-home.layout>