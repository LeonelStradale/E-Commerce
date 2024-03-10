<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type = '';
    public $street = '';
    public $neighborhood = '';
    public $postal_code = '';
    public $town = '';
    public $state = '';
    public $reference = '';
    public $receiver = 1;
    public $receiver_info = [];
    public $default = false;
}
