<div class="wrap-inner col-md-8 col-12">

    @forelse($addresses as $address)
        <label wire:click="selectAddress" @class(["tf-card-article select-account-sku style-1 cursor-pointer", "radio-checked" => $selectedAddressId == $address->id])>
            <div  @class(["inner w-100"])>
                @if($addresses->isNotEmpty())
                    <div class="meta-info d-flexitems-center">
                        <div class="item my-3 active">
                            <div class="item my-3"> آدرس تحویل سفارش</div>
                        </div>
                    </div>
                    <div class="card-title">
                        <h2>{{ $address->city?->province?->name ?? '' }}، {{ $address->city->name ?? '' }}، {{ $address->address ?? '' }}</a></h2>
                    </div>
                    <div class="card-bottom d-flexitems-center justify-between">
                        <div class="author d-flexitems-center justify-between">
                            <div class="info">
                                <span>دریافت کننده</span>

                                @if($address->otherRecipient)
                                    <h3>
                                        <p>{{ $address->recipient_first_name ?? '' }}</p>
                                        <p>{{ $address->recipient_last_name ?? '' }}</p>
                                        <p>{{ $address->user?->mobile ?? '' }}</p>
                                    </h3>
                                @else
                                    <h3>
                                        <p>{{ $address->user?->name ?? '' }}</p>
                                        <p>{{ $address->user?->profile?->phone ?? '' }}</p>
                                        <p>{{ $address->user?->email ?? '' }}</p>
                                    </h3>
                                @endif

                            </div>
                        </div>
                        <a class="link" href="#" data-toggle="modal"
                           data-target="#edit-address-{{ $address->id }}"> <span class="fa fa-edit"></span> </a>
                    </div>
                    <input wire:model="selectedAddressId" type="radio" name="address_id" id="address-{{ $address->id }}" value="{{ $address->id }}" checked>
                @endif
            </div>

        </label>

        <x-home.modal-popup-bid id="edit-address-{{ $address->id }}" wire:ignore.self>
            <x-slot:content>

                <button type="button" class="close red-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body p-0">
                    <div class="widget-edit px-3  profile">
                        <div class="title">
                            <h4>ویرایش آدرس </h4>
                        </div>
                        <form class="comment-form" wire:submit.prevent="editAddress" method="POST">
                            @csrf
                            <div class="d-flex">
                                <fieldset class="location">
                                    <label wire:click="selectProvince" for="province"><select wire:model="selectedProvince" class="select" name="province" id="province">
                                            @forelse($provinces as $province)
                                                <option value="{{ $province->id }}" @selected($province->id == $address->city?->province?->id)>{{ $province->name ?? '' }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </label>
                                </fieldset>
                                <fieldset class="location">
                                    <label for="city"><select wire:model="selectedCity" class="select" name="city" id="city">
                                            @isset($cities)
                                                @forelse($cities as $city)
                                                    <option value="{{ $city->id }}" @selected($city->id == $address->city?->id)>{{ $city->name ?? '' }}</option>
                                                @empty
                                                @endforelse
                                                <option disabled>استان را انتخال کنید</option>
                                            @endisset
                                        </select>
                                    </label>
                                </fieldset>
                            </div>
                            <div class="d-flex">
                                <fieldset class="address w-100">
                                    <input wire:model="address" type="text" id="address" placeholder=" آدرس" name="address" value="{{ $address->address }}">
                                </fieldset>
                            </div>
                            <div class="d-flex">
                                <fieldset class="address">
                                    <input wire:model="postal_code" type="text" id="postal_code" placeholder="کد پستی" name="postal_code" value="{{ $address->postal_code }}">
                                </fieldset>
                                <fieldset class="address">
                                    <input wire:model="no" type="text" id="no" placeholder="پلاک" name="no" value="{{ $address->no }}">
                                </fieldset>
                                <fieldset class="address">
                                    <input wire:model="unit" type="text" id="unit" placeholder="واحد" name="unit" value="{{ $address->unit }}">
                                </fieldset>
                            </div>

                            <div class="btn-submit">
                                <button type="submit" class="tf-button blue-btn style-1 h50">ثبت آدرس<i class="icon-add"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

            </x-slot:content>

        </x-home.modal-popup-bid>
    @empty
    @endforelse


    <div class="widget-content-tab">
        <div class="widget-content-inner upload active" style="">
            <div class="wrap-upload w-full">

                <label class="uploadfile py-5">
                    <x-home.button
                            class="mx-auto"
                            href="#"
                            data-toggle="modal"
                            data-target="#add-address"
                            title="افزودن آدرس جدید"
                            icon="icon-add"
                    />
                </label>

                <x-home.modal-popup-bid id="add-address" wire:ignore.self>

                    <x-slot:content>

                        <button type="button" class="close red-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body p-0">
                            <div class="widget-edit px-3 profile">
                                <div class="title">
                                    <h4>افزودن آدرس</h4>
                                </div>
                                <form class="comment-form" wire:submit.prevent="addAddress" method="POST">
                                    @csrf
                                    <div class="d-flex">
                                        <fieldset class="location">
                                            <label wire:click="selectProvince" for="province"><select wire:model="selectedProvince" class="select" name="province" id="province">
                                                    @forelse($provinces as $province)
                                                        <option value="{{ $province->id }}">{{ $province->name ?? '' }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </label>
                                        </fieldset>
                                        <fieldset class="location">
                                            <label for="city"><select wire:model="selectedCity" class="select" name="city" id="city">
                                                    @isset($cities)
                                                        @forelse($cities as $city)
                                                            <option value="{{ $city->id }}">{{ $city->name ?? '' }}</option>
                                                        @empty
                                                        @endforelse
                                                        <option disabled>استان را انتخال کنید</option>
                                                    @endisset
                                                </select>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="d-flex">
                                        <fieldset class="address w-100">
                                            <input wire:model="address" type="text" id="address" placeholder=" آدرس" name="address">
                                        </fieldset>
                                    </div>
                                    <div class="d-flex">
                                        <fieldset class="address">
                                            <input wire:model="postal_code" type="text" id="postal_code" placeholder="کد پستی" name="postal_code">
                                        </fieldset>
                                        <fieldset class="address">
                                            <input wire:model="no" type="text" id="no" placeholder="پلاک" name="no">
                                        </fieldset>
                                        <fieldset class="address">
                                            <input wire:model="unit" type="text" id="unit" placeholder="واحد" name="unit">
                                        </fieldset>
                                    </div>

                                    <div class="btn-submit">
                                        <button type="submit" class="tf-button blue-btn style-1 h50">ثبت آدرس<i class="icon-add"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </x-slot:content>

                </x-home.modal-popup-bid>

            </div>
        </div>
    </div>
</div>
