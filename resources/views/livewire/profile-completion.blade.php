    <div class="widget-edit mb-30 profile">
        <div class="title">
            <h4>ویرایش اطلاعات</h4>
            <i class="icon-keyboard_arrow_up"></i>
        </div>

        <x-home.flash-message/>

        <form wire:submit.prevent="save">
            <div class="flex gap30">
                @if(empty(auth()->user()->name))
                    <fieldset class="name">
                        <label for="name">نام*</label>
                        <input wire:model="form.name" type="text" id="name" placeholder="نام و نام خانوادگی" class="@error('form.name') error border-danger @enderror" name="name" value="{{ auth()->user()->name ?? '' }}">
                        @error('form.name') <span class="text-danger sub-text">{{ $message }}</span> @enderror
                    </fieldset>
                @endif
                @if(empty(auth()->user()->mobile))
                    <fieldset class="mobile">
                        <label for="mobile">شماره تلفن*</label>
                        <input wire:model="form.mobile" type="text" id="mobile" placeholder="تلفن" class="@error('form.mobile') error border-danger @enderror" name="mobile" value="{{ auth()->user()->mobile ?? '' }}">
                        @error('form.mobile') <span class="text-danger sub-text">{{ $message }}</span> @enderror
                    </fieldset>
                @endif

            </div>
            <div class="flex gap30">
                @if(empty(auth()->user()->email))
                    <fieldset class="email">
                        <label for="email">ایمیل*</label>
                        <input wire:model="form.email" type="email" id="email" placeholder="ایمیل" class="@error('form.email') error border-danger @enderror" name="email" value="{{ auth()->user()->email ?? '' }}">
                        @error('form.email') <span class="text-danger sub-text">{{ $message }}</span> @enderror
                    </fieldset>
                @endif
                @if(empty(auth()->user()->profile?->national_code))
                    <fieldset class="national_code">
                        <label for="national_code">کد ملی*</label>
                        <input wire:model="form.nationalCode" type="number" id="national_code" placeholder="کد ملی" name="national_code" class="@error('form.nationalCode') error border-danger @enderror" value="{{ auth()->user()->profile->national_code ?? '' }}">
                        @error('form.nationalCode') <span class="text-danger sub-text">{{ $message }}</span> @enderror
                    </fieldset>
                @endif
            </div>

            @if(empty(auth()->user()->name) || empty(auth()->user()->email) ||empty(auth()->user()->profile?->national_code) ||empty(auth()->user()->mobile) )
                <div class="btn-submit">
                    <button class="w242 d-flex justify-content-center align-items-center" type="submit">ثبت

                        <div wire:loading>
                            <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <style>.spinner_P7sC {
                                        transform-origin: center;
                                        animation: spinner_svv2 .75s infinite linear
                                    }

                                    @keyframes spinner_svv2 {
                                        100% {
                                            transform: rotate(360deg)
                                        }
                                    }</style>
                                <path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" class="spinner_P7sC"/>
                            </svg>
                        </div>
                    </button>
                    <x-action-message class="mr-3" on="saved">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            @endif
        </form>

    </div>
