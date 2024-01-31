<header id="header_main" class="header_1 header-fixed bg-blur px-3 border-gray" :class="{ 'style-white' : Light}" dir="rtl">
    <div class="py-2 themesflat-container w-100">
        <div class="row">
            <div class="col-md-12">
                <div id="site-header-inner">
                    <div class="align-items-center flex gap30 wrap-box justify-content-between flex-row-reverse">
                        {{--                        <div class="d-flex gap30 items-center justify-between">--}}
                        {{--                            <svg @click="toggleTheme()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 animated  fadeIn text-warning" x-show="Light === false" width="30">--}}
                        {{--                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>--}}
                        {{--                            </svg>--}}
                        {{--                            <svg @click="toggleTheme()" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 animated  fadeIn text-gray-dark" x-show="Light === true" width="30">--}}
                        {{--                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>--}}
                        {{--                            </svg>--}}
                        {{--                        </div>--}}

                        <div class="flex">
                            @auth
                                <div class="admin_active" id="header_admin">

                                    <livewire:user-cart-items/>

                                    <div class="popup-user relative" id="header_admin_wallet">
                                        <div class="user">
                                            <x-home.button
                                                    class="green-btn"
                                                    href="#"
                                                    title="کیف پول : {{ priceFormat(auth()->user()->wallet()) }}"
                                                    icon="icon-wa"
                                            />
                                        </div>

                                        <div class="avatar_popup2">
                                            <div class="links" dir="rtl">
                                                <a class="block mb-30" href="{{ route('user.profile') }}" wire:navigate.hover>
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.774902 18.333C0.774902 18.7932 1.14762 19.1664 1.60824 19.1664C2.06885 19.1664 2.44157 18.7932 2.44157 18.333C2.44157 15.3923 4.13448 12.7889 6.77329 11.5578C7.68653 12.1513 8.77296 12.4997 9.94076 12.4997C11.113 12.4997 12.2036 12.1489 13.119 11.5513C13.9067 11.9232 14.6368 12.4235 15.2443 13.0307C16.6611 14.4479 17.4416 16.3311 17.4416 18.333C17.4416 18.7932 17.8143 19.1664 18.2749 19.1664C18.7355 19.1664 19.1083 18.7932 19.1083 18.333C19.1083 15.8859 18.1545 13.5845 16.4227 11.8523C15.8432 11.2725 15.1698 10.7754 14.4472 10.3655C15.2757 9.3581 15.7741 8.06944 15.7741 6.66635C15.7741 3.44979 13.1569 0.833008 9.94076 0.833008C6.72461 0.833008 4.10742 3.44979 4.10742 6.66635C4.10742 8.06604 4.60379 9.35154 5.42863 10.3579C2.56796 11.9685 0.774902 14.9779 0.774902 18.333V18.333ZM9.94076 2.49968C12.2381 2.49968 14.1074 4.36898 14.1074 6.66635C14.1074 8.96371 12.2381 10.833 9.94076 10.833C7.6434 10.833 5.77409 8.96371 5.77409 6.66635C5.77409 4.36898 7.6434 2.49968 9.94076 2.49968V2.49968Z"
                                                              fill="white"></path>
                                                    </svg>
                                                    <span>حساب کاربری</span>
                                                </a>
                                                <form method="POST" action="{{ route('logout') }}" id="logout_form">
                                                    @csrf
                                                    <a class="block cursor-pointer" id="logout" onclick="$('#logout_form').submit()">
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.9668 18.3057H2.49168C2.0332 18.3057 1.66113 17.9335 1.66113 17.4751V2.52492C1.66113 2.06644 2.03324 1.69437 2.49168 1.69437H9.9668C10.4261 1.69437 10.7973 1.32312 10.7973 0.863828C10.7973 0.404531 10.4261 0.0332031 9.9668 0.0332031H2.49168C1.11793 0.0332031 0 1.15117 0 2.52492V17.4751C0 18.8488 1.11793 19.9668 2.49168 19.9668H9.9668C10.4261 19.9668 10.7973 19.5955 10.7973 19.1362C10.7973 18.6769 10.4261 18.3057 9.9668 18.3057Z"
                                                                  fill="white"></path>
                                                            <path d="M19.7525 9.40904L14.7027 4.42564C14.3771 4.10337 13.8505 4.10755 13.5282 4.43396C13.206 4.76036 13.2093 5.28611 13.5366 5.60837L17.1454 9.16982H7.47508C7.01578 9.16982 6.64453 9.54107 6.64453 10.0004C6.64453 10.4597 7.01578 10.8309 7.47508 10.8309H17.1454L13.5366 14.3924C13.2093 14.7147 13.2068 15.2404 13.5282 15.5668C13.691 15.7313 13.9053 15.8143 14.1196 15.8143C14.3306 15.8143 14.5415 15.7346 14.7027 15.5751L19.7525 10.5917C19.9103 10.4356 20 10.2229 20 10.0003C20 9.77783 19.9111 9.56603 19.7525 9.40904Z"
                                                                  fill="white"></path>
                                                        </svg>
                                                        <span>خروج</span>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                            @guest
                                <x-home.button
                                        id="connectbtn"
                                        class="green-btn"
                                        href="{{ route('auth.authentication-form') }}"
                                        title="ورود | ثبت نام"
                                        icon="fa fa-arrow-right-to-bracket"
                                />
                            @endguest
                        </div>

                        <div class="mobile-button">
                            <span></span>
                        </div>

                        <x-home.main-nav :parentMenus="$headerParentMenuItems"/>

                        <div class="align-items-center d-flex flex-row-reverse gap30 justify-content-around mr-30">
                            <x-home.logo
                                    class="logo-circle"
                                    href="{{ route('home') }}"
                                    link-class="main-logo"
                                    src="{{ asset('storage/' . $setting->logo) }}"
                                    alt="home-logo"
                                    id="logo_header"
                            />

                            <div class="header-search relative">
                                <div class="top-search">
                                    <livewire:global-search wire:key="global-search"/>
                                </div>
                                <a href="#" class="show-search">
                                    <i class="icon-search"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-home.mobile-nav-wrap :parentMenus="$headerParentMenuItems"/>

</header>

<div class="mobile-search my-3 px-2 relative">
    <div class="top-search">
    <livewire:global-search wire:key="global-search-under-header"/>
    </div>
    <a href="#" class="show-search">
        <i class="icon-search"></i>
    </a>
</div>
