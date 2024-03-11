<?php

namespace App\Livewire\Forms;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Validation\Rules\Enum;
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

    public function rules()
    {
        return [
            'type' => 'required|in:1,2',
            'street' => 'required|string',
            'neighborhood' => 'required|string',
            'postal_code' => 'required|string',
            'town' => 'required|string',
            'state' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => [
                'required',
                new Enum(TypeOfDocuments::class)
            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',
        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => 'tipo de dirección',
            'street' => 'calle',
            'neighborhood' => 'colonia',
            'postal_code' => 'código Postal',
            'town' => 'municipio',
            'state' => 'estado',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre',
            'receiver_info.last_name' => 'apellidos',
            'receiver_info.document_type' => 'tipo de documento',
            'receiver_info.document_number' => 'clave de documento',
            'receiver_info.phone' => 'teléfono',
        ];
    }

    public function save()
    {
        $this->validate();

        if (auth()->user()->addresses->count() === 0) {
            $this->default = true;
        }

        Address::create([
            'user_id' => auth()->id(),
            'type' => $this->type,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'postal_code' => $this->postal_code,
            'town' => $this->town,
            'state' => $this->state,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
        ]);

        $this->reset();

        $this->receiver_info = [
            'name' => auth()->user()->name,
            'last_name' => auth()->user()->last_name,
            'document_type' => auth()->user()->document_type,
            'document_number' => auth()->user()->document_number,
            'phone' => auth()->user()->phone,
        ];
    }
}
