<x-home.layout>
    <x-slot:title>تماس با ما</x-slot:title>
    <x-slot:url>https://gpgaming.ir/</x-slot:url>
    <x-slot:name>گیم پردایس</x-slot:name>



    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a href="{{ route('home') }}"> خانه </a></li>
            <li><a> ارتباط با ما </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-2 contact-us">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-gg-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13286.718711192168!2d46.40476763249613!3d33.63954663256391!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ffb4cbec2900001%3A0xec53b503a165f843!2sTimorpoor!5e0!3m2!1sen!2s!4v1695573171922!5m2!1sen!2s"
                                width="100%" height="460" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-section-2 widget-box-icon">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section-1">
                        <h2 class="tf-title pb-20">راه های ارتباطی</h2>
                        <p class="pb-40">ساعت کاری فروشگاه برای ارتباط با پشتیبانی از 15 الی 22 روزهای غیرتعطیل می باشد در طول این زمان با ما از طریق پیامک یا واتس اپ یا تلگرام ارتباط برقرار کرده و نهایتا تا ساعت 24:00 همان روز، پاسخ پیام های خود را دریافت نمایید.</p>
                    </div>
                </div>
                <div data-wow-delay="0s" class="wow fadeInUp col-md-4">
                    <div class="box-icon-item">
                        <img src="{{ asset('assets/images/box-icon/address.png') }}" alt="address">
                        <div class="title"><a href="#">آدرس</a></div>
                        <p>ایلام، خیابان تختی ، پاساژ تیمورپور ، طبقه پایین ، فروشگاه عرضه کنسول های بازی و لوازم جانبی و اکانت های قانونی</p>
                    </div>
                </div>
                <div data-wow-delay="0.1s" class="wow fadeInUp col-md-4">
                    <div class="box-icon-item">
                        <img src="{{ asset('assets/images/box-icon/email.png') }}" alt="email">
                        <div class="title"><a href="mailto:gameparadisestore@gmail.com">ایمیل</a></div>
                        <p>gameparadisestore@gmail.com</p>
                    </div>
                </div>
                <div data-wow-delay="0.2s" class="wow fadeInUp col-md-4">
                    <div class="box-icon-item">
                        <img src="{{ asset('assets/images/box-icon/phone.png') }}" alt="phone">
                        <div class="title"><a href="#">تماس تلفنی</a></div>
                        <p>09380807874 <br>
                            08433369100</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-section-2 widget-box-icon">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section-1">
                        <h2 class="tf-title pb-20">تماس با ما</h2>
                        <p class="pb-40">پس از ارسال پیام ، به هیچ عنوان اقدام به بروز رسانی پیام های ارسالی خود نکنید زیرا جایگاه خود را از دست داده و رسیدگی به درخواست، زمان بیشتری خواهد برد.
                            درخواست های مرتبط با سفارش های خود را فقط از طریق ارسال پیامک و یا در تلگرام یا واتس اپ در ساعت کاری به شماره تماس 09380807874 ثبت نمایید.
                            شرح موضوع و ارسال شماره سفارش در پیامک، لازم است.</p>
                    </div>
                </div>
                <div class="col-12" dir="rtl">
                    <form method="POST" action="{{ route('support.contact-us.store') }}" id="commentform" class="comment-form">
                        @csrf
                        <div class="flex gap30">
                            @auth
                                <fieldset class="name">
                                    <input class="style-1" type="text" id="name" placeholder="نام و نام خانوادگی*" name="name" tabindex="2" value="{{ auth()->user()->name }}" aria-required="true" required>
                                </fieldset>
                                <fieldset class="email">
                                    <input class="style-1" type="email" id="email" placeholder="ایمیل*" name="email" tabindex="2" value="{{ auth()->user()->email }}" aria-required="true" required>
                                </fieldset>
                            @endauth
                            <fieldset class="subject">
                                <input class="style-1" type="text" id="subject" placeholder="موضوع" name="subject" tabindex="2" value="" aria-required="true" required>
                            </fieldset>
                        </div>
                        <fieldset class="message">
                            <textarea class="style-1" id="message" name="message" rows="4" placeholder="متن پیام*" tabindex="4" aria-required="true" required></textarea>
                        </fieldset>
                        <div class="btn-submit">
                            <button class="tf-button style-1" type="submit">ارسال پیام <i class="icon-arrow-up-right2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-home.footer/>

</x-home.layout>