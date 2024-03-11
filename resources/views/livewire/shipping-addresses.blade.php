<div>
    <section class="bg-white rounded-lg shadow-2xl overflow-hidden">
        <header class="bg-purple-600 px-4 py-2">
            <h2 class="text-white text-lg">
                Direcciones de envío guardadas
            </h2>
        </header>
        <div class="p-4">
            @if ($newAddress)
                <x-validation-errors class="mb-6" />
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <x-select class="w-full" wire:model="createAddress.type">
                            <option selected disabled value="">
                                Tipo de dirección
                            </option>
                            <option value="1">
                                Domicilio
                            </option>
                            <option value="2">
                                Oficina
                            </option>
                        </x-select>
                    </div>
                    <div class="col-span-1">
                        <x-input type="text" class="w-full" wire:model="createAddress.street" placeholder="Calle" />
                    </div>
                    <div class="col-span-1">
                        <x-input type="text" class="w-full" wire:model="createAddress.neighborhood"
                            placeholder="Colonia" />
                    </div>
                    <div class="col-span-1">
                        <x-input type="text" class="w-full" wire:model="createAddress.postal_code"
                            placeholder="Código Postal" />
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    <div class="col-span-1">
                        <x-input type="text" class="w-full" wire:model="createAddress.town"
                            placeholder="Municipio" />
                    </div>
                    <div class="col-span-1">
                        <x-input type="text" class="w-full" wire:model="createAddress.state" placeholder="Estado" />
                    </div>
                    <div class="col-span-1">
                        <x-input type="text" class="w-full" wire:model="createAddress.reference"
                            placeholder="Referencias" />
                    </div>
                </div>
                <hr class="my-4">
                <div x-data="{
                    receiver: @entangle('createAddress.receiver'),
                    receiver_info: @entangle('createAddress.receiver_info')
                }" x-init="$watch('receiver', value => {
                    if (value == 1) {
                        receiver_info.name = '{{ auth()->user()->name }}';
                        receiver_info.last_name = '{{ auth()->user()->last_name }}';
                        receiver_info.document_type = '{{ auth()->user()->document_type }}';
                        receiver_info.document_number = '{{ auth()->user()->document_number }}';
                        receiver_info.phone = '{{ auth()->user()->phone }}';
                    } else {
                        receiver_info.name = '';
                        receiver_info.last_name = '';
                        receiver_info.document_number = '';
                        receiver_info.phone = '';
                    }
                })">
                    <p class="font-semibold mb-2">
                        ¿Quién recibirá el pedido?
                    </p>
                    <div class="flex space-x-2">
                        <label class="flex items-center">
                            <input x-model="receiver" class="mr-1" type="radio" value="1">
                            Seré yo
                        </label>
                        <label class="flex items-center">
                            <input x-model="receiver" class="mr-1" type="radio" value="2">
                            Otra persona
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <div>
                            <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.name" class="w-full"
                                placeholder="Nombre" />
                        </div>
                        <div>
                            <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.last_name" class="w-full"
                                placeholder="Apellidos" />
                        </div>
                        <div>
                            <div class="flex space-x-2">
                                <x-select x-bind:disabled="receiver == 1" x-model="receiver_info.document_type">
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{ $item->value }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.document_number"
                                    class="w-full" placeholder="Clave de documento" />
                            </div>
                        </div>
                        <div>
                            <x-input x-bind:disabled="receiver == 1" x-model="receiver_info.phone" class="w-full"
                                placeholder="Teléfono" />
                        </div>
                        <div class="mt-2">
                            <button wire:click="$set('newAddress', false)" class="btn btn-outline-gray w-full">
                                Cancelar
                            </button>
                        </div>
                        <div class="mt-2">
                            <button wire:click="store" class="btn btn-purple w-full">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            @else
                @if ($addresses->count())
                    <ul class="grid grid-cols-2 gap-4">
                        @foreach ($addresses as $address)
                            <li class="{{ $address->default ? 'bg-purple-200' : 'bg-white' }} rounded-xl shadow-xl"
                                wire:key="addresses-{{ $address->id }}">
                                <div class="p-4 flex items-center">
                                    <div>
                                        <i class="fa-solid fa-house text-purple-600 text-2xl"></i>
                                    </div>
                                    <div class="flex-1 mx-4 text-xs">
                                        <p class="text-purple-600">
                                            {{ $address->type == 1 ? 'Domicilio' : 'Oficina' }}
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            {{ $address->street }}, {{ $address->neighborhood }}
                                            {{ $address->postal_code }}.
                                        </p>
                                        <p class="text-gray-700 font-semibold">
                                            {{ $address->town }}, {{ $address->state }}.
                                        </p>
                                        <p class="text-gray-700">
                                            {{ $address->receiver_info['name'] }}
                                        </p>
                                    </div>
                                    <div class="text-xs text-gray-800 flex flex-col gap-1">
                                        <button wire:click="setDefaultAddress({{ $address->id }})">
                                            <i class="fa-solid fa-star"></i>
                                        </button>
                                        <button>
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <button wire:click="deleteAddress({{ $address->id }})">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>
                        No se direcciones guardadas.
                    </p>
                @endif
                <button wire:click="$set('newAddress', true)"
                    class="btn btn-outline-gray w-full flex items-center justify-center mt-4">
                    <i class="fa-solid fa-plus mr-2"></i> Agregar
                </button>
            @endif
        </div>
    </section>
</div>
