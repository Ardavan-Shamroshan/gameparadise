<div class="mobile-nav-wrap">
    <div class="overlay-mobile-nav"></div>
    <div class="inner-mobile-nav" dir="ltr">
        <a wire:navigate.hover href="{{ route('home') }}" rel="home" class="main-logo">
            <img id="mobile-logo_header"
                 class="logo-circle"
                 src="{{ asset('assets/images/logo/asli.png') }}" alt="gpgaming">
        </a>
        <div class="mobile-nav-close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="white" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g>
                    <path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/>
                </g></svg>
        </div>

        <nav id="mobile-main-nav" class="mobile-main-nav">
            <ul id="menu-mobile-menu" class="menu pt-0">
                <li class="menu-item" dir="rtl">
                    <livewire:global-search wire:key="global-search-sidebar"/>
                </li>
                @forelse($parentMenus as $parent)

                    @php($active = false)
                    @if($parent->children->isNotEmpty())
                        @php($active = false)
                        @foreach($parent->children->pluck('value') as $childUrl)
                            @if($childUrl == request()->route()->uri)
                                @php($active = true)
                            @endif
                        @endforeach
                    @endif

                    <li @class([
            "menu-item",
             "menu-item-has-children-mobile" => $parent->children->isNotEmpty(),
             "current-menu-item" => ((request()->route()->uri == $parent->value) || $active)
             ])>

                        @if($parent->children->isNotEmpty())
                            <a class="item-menu-mobile">{{ $parent->name ?? '' }}</a>
                        @else
                            <a class="item-menu-mobile" href="{{ url($parent->value ?? '') }}" wire:navigate.hover>{{ $parent->name ?? '' }}</a>
                        @endif

                        <x-home.mobile-main-nav-children :children="$parent->children"/>
                    </li>
                @empty
                @endforelse

                @auth
                    <li @class(["menu-item"])>
                        <a href="{{ route('user.profile') }}">حساب کاربری</a>
                    </li>
                    <li @class([ "menu-item"])>
                        <form method="POST" action="{{ route('logout') }}" id="logout_form-mobile">
                            @csrf
                            <a class="block cursor-pointer" id="logout" onclick="$('#logout_form-mobile').submit()">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.9668 18.3057H2.49168C2.0332 18.3057 1.66113 17.9335 1.66113 17.4751V2.52492C1.66113 2.06644 2.03324 1.69437 2.49168 1.69437H9.9668C10.4261 1.69437 10.7973 1.32312 10.7973 0.863828C10.7973 0.404531 10.4261 0.0332031 9.9668 0.0332031H2.49168C1.11793 0.0332031 0 1.15117 0 2.52492V17.4751C0 18.8488 1.11793 19.9668 2.49168 19.9668H9.9668C10.4261 19.9668 10.7973 19.5955 10.7973 19.1362C10.7973 18.6769 10.4261 18.3057 9.9668 18.3057Z"
                                          fill="white"></path>
                                    <path d="M19.7525 9.40904L14.7027 4.42564C14.3771 4.10337 13.8505 4.10755 13.5282 4.43396C13.206 4.76036 13.2093 5.28611 13.5366 5.60837L17.1454 9.16982H7.47508C7.01578 9.16982 6.64453 9.54107 6.64453 10.0004C6.64453 10.4597 7.01578 10.8309 7.47508 10.8309H17.1454L13.5366 14.3924C13.2093 14.7147 13.2068 15.2404 13.5282 15.5668C13.691 15.7313 13.9053 15.8143 14.1196 15.8143C14.3306 15.8143 14.5415 15.7346 14.7027 15.5751L19.7525 10.5917C19.9103 10.4356 20 10.2229 20 10.0003C20 9.77783 19.9111 9.56603 19.7525 9.40904Z"
                                          fill="white"></path>
                                </svg>
                                <span>خروج</span>
                            </a>
                        </form>
                    </li>
                @endauth
                @guest
                    <li @class(["menu-item"])>
                        <a href="{{ route('login') }}">ورود | ثبت نام</a>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</div>


