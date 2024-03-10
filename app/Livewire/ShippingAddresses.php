<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;

    public $newAddress = false;

    public CreateAddressForm $createAddress;

    public function mount()
    {
        $this->addresses = Address::where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
