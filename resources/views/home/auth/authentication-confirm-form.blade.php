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
                            <div style="display: block; text-align: center; position: relative; transform-origin: 460px 27.5px; transform: translate3d(0px, 0px, 0px); opacity: 1;">کد تایید</div>
                        </h2>
                        <p class="pb-40">کد تایید به شماره تلفن شما ارسال شد.</p>
                    </div>
                </div>
                <div class="col-sm-11 col-md-6 mx-auto">

                    <x-home.flash-message/>


                    <div class="widget-login">
                        <form method="POST" action="{{ route('auth.confirmation', $token) }}" class="comment-form">
                            @csrf

                            <fieldset class="code">
                                <label for="code">کد تایید *</label>
                                <input type="text" id="code" name="code">
                            </fieldset>

                            <div class="btn-submit mb-30">
                                <button class="tf-button blue-btn style-1 h50 w-100" type="submit">تایید<i class="icon-arrow-up-right2"></i></button>
                            </div>

                            <div class="text-center pb-0 sub-text">
                                <div id="resend-otp" class="d-none">
                                    <a href="{{ route('auth.resend-otp', $token) }}" class="text-decoration-none text-primary">دریافت مجدد کد تایید</a>
                                </div>
                                <div id="timer"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        @php
            // $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(2)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
            $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(2)->timestamp - \Carbon\Carbon::now()->timestamp) * 100;
        @endphp

        <script>
            var countDownDate = new Date().getTime() + {{ $timer }};
            var timer = $('#timer');
            var resend_otp = $('#resend-otp');

            var x = setInterval(function () {
                var now = new Date().getTime(); // current time
                var distance = countDownDate - now; // period time between otp created time and current time

                // extract seconds and minutes from timestamp format
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // convert numbers(seconds and minutes) in minimum two digits => 02:56, 00:32
                minutes = minutes.toLocaleString(undefined, {minimumIntegerDigits: 2})
                seconds = seconds.toLocaleString(undefined, {minimumIntegerDigits: 2})

                if (minutes === 0)
                    timer.html(seconds + ' : ' + minutes + ' تا  ارسال مجدد کد تایید');
                else
                    timer.html(seconds + ' : ' + minutes + ' تا  ارسال مجدد کد تایید');

                if (distance < 0) {
                    clearInterval(x);
                    timer.addClass('d-none');
                    resend_otp.removeClass('d-none');
                }
            }, 1000);
        </script>

    @endpush


</x-home.layout>