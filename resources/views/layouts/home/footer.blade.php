<footer id="footer" :class="{ 'bg-white': Light }" class="rounded-85 border-gray" dir="rtl">
    <div class="themesflat-container px-2">
        <div class="row">
            <div class="col-12">
                <div class="footer-content flex flex-grow gap30">
                    <div class="widget-logo flex-grow">
                        <div class="logo-footer" id="logo-footer">

                            <div class="text mt-3">
                                <div><span class="text-info">آدرس فروشگاه :</span>{{ $setting->address ?? '-' }} </div>
                                <div><span class="text-info">مدیریت :</span> مرتضی شیردل</div>

                                @forelse($setting->socials as $social)
                                    @php($media = $setting->socialMedias($social['socials'], $social['address']))
                                    <div><span class="text-info">{{ $media['name'] }} :  </span><a href="{{ $media['link'] }}" target="_blank" class="text-primary">{{ $social['address'] }}</a></div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <x-home.footer-widget-menu :parentMenus="$footerParentMenuItems"/>
                </div>

                <div class="col-12 d-flex justify-content-start mt-3">
                    <div class="col-md-1 col-sm-2">
                        <a target="_blank" rel="origin" href="https://trustseal.enamad.ir/?id=189221&amp;Code=hhMb2DnoQz5bqKpHH76L">
                            {{--                                <img src="https://Trustseal.eNamad.ir/logo.aspx?id=189221&amp;Code=hhMb2DnoQz5bqKpHH76L" alt="logo-enamad" class=" bg-faded rounded" style="cursor:pointer" id="hhMb2DnoQz5bqKpHH76L">--}}
                            <img src="{{ asset('assets/images/e-namad.png') }}" alt="logo-enamad" class=" bg-faded rounded" style="cursor:pointer" id="hhMb2DnoQz5bqKpHH76L">
                        </a>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <img referrerpolicy="origin" id='nbqeesgtoeukapfuapfuesgt' style='cursor:pointer'
                             onclick='window.open("https://logo.samandehi.ir/Verify.aspx?id=208550&p=uiwkobpdmcsidshwdshwobpd", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")'
                             alt='logo-samandehi' src='{{ asset('assets/images/samandehi.png') }}'/>
                    </div>
                </div>


                <div class="col-12 text-right">
                    <h2 class="title-widget mt-30">همراه ما باشید</h2>
                    {{--                    @forelse($setting->socials as $social)--}}
                    {{--                        @php($media = $setting->socialMedias($social['socials'], $social['address']))--}}
                    <x-home.widget-social :$media/>
                    {{--                    @empty--}}
                    {{--                    @endforelse--}}
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>کلیه حقوق سایت برای گیم پردایس محفوظ است. استفاده غیرتجاری مطلب همراه با ذکر منبع و لینک مجاز می‌باشد. تاسیس از 1396</p>
            <ul class="flex">
                <li><span>طراحی و توسعه</span><a href="mailto:ardavanshamroshan@yahoo.com" target="_blank"> اردوان شام روشن <span>ardavanshamroshan@yahoo.com</span> </a></li>
            </ul>
        </div>
    </div>
</footer>