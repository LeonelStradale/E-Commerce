<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">
        <header class="bg-purple-600 px-4 py-2">
            <h2 class="text-white text-lg">
                Direcciones de envío guardadas
            </h2>
        </header>
        <div class="p-4">
            @if ($newAddress)
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
                <div>
                    <p class="font-semibold mb-2">
                        ¿Quién recibirá el pedido?
                    </p>
                    <div class="flex space-x-2">
                        <label class="flex items-center">
                            <input class="mr-1" type="radio" value="1">
                            Seré yo
                        </label>
                        <label class="flex items-center">
                            <input class="mr-1" type="radio" value="2">
                            Otra persona
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <div>
                            <x-input class="w-full" placeholder="Nombre" />
                        </div>
                        <div>
                            <x-input class="w-full" placeholder="Apellidos" />
                        </div>
                        <div>
                            <div class="flex space-x-2">
                                <x-select>
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{ $item->value }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input class="w-full" placeholder="Clave de documento" />
                            </div>
                        </div>
                        <div>
                            <x-input class="w-full" placeholder="Teléfono" />
                        </div>
                        <div>
                            <button wire:click="$set('newAddress', false)" class="btn btn-outline-gray w-full">
                                Cancelar
                            </button>
                        </div>
                        <div>
                            <button class="btn btn-purple w-full">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            @else
                @if ($addresses->count())
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
