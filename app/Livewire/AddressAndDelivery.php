<?php

namespace App\Livewire;

use App\Models\Shop\Address\Address;
use App\Models\Shop\Address\Province;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddressAndDelivery extends Component
{
    use LivewireAlert;

    public $addresses;
    public $provinces;
    public $cities;
    public $selectedAddressId;
    public $selectedAddress;
    public $selectedProvince;
    public $selectedCity;

    #[Rule('required')]
    public $address;

    #[Rule('required')]
    public $unit;

    #[Rule('required')]
    public $no;

    #[Rule('required')]
    public $postal_code;

    #[Rule('nullable')]
    public $otherRecipient;

    #[Rule('nullable')]
    public $recipientFirstName;

    #[Rule('nullable')]
    public $recipientLastName;

    #[Rule('nullable')]
    public $mobile;


    /**
     * Runs once, immediately after the component is instantiated,
     * but before render() is called.
     * This is only called once on initial page load and never called again, even on component refreshes
     * @return void
     */


    public function mount($addresses, $provinces)
    {
        $this->addresses = $addresses;
        $this->provinces = $provinces;

        $firstSelectedProvinceQuery = Province::query()->latest()->first();
        $this->selectedProvince = $firstSelectedProvinceQuery->id;
        $this->cities = $firstSelectedProvinceQuery->cities;
        $this->selectedAddress = auth()->user()?->addresses()?->first();
        $this->selectedAddressId = auth()->user()?->addresses()?->first()?->id;
        // $this->selectedAddress = $this->addresses->first();
    }

    #[On('address-added')]
    public function refreshUserAddresses()
    {
        $this->addresses = auth()->user()->addresses;
    }

    public function selectProvince()
    {
        $this->cities = Province::query()->find($this->selectedProvince)
            ->cities;
    }

    public function selectAddress()
    {
        $this->selectedAddress = Address::query()->findOrFail($this->selectedAddressId);
    }

    public function addAddress()
    {
        try {
            $validated = $this->validate();
            $validated['user_id'] = auth()->id();
            $validated['city_id'] = $this->selectedCity;
            $validated['status'] = 1;

            Address::query()->create($validated);
            $this->dispatch('address-added');
            $this->alert('success', "آدرس با موفقیت ثبت شد", ['toast' => false]);
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage(), ['toast' => false]);
        }
    }


    public function render()
    {
        return view('livewire.address-and-delivery');
    }
}
