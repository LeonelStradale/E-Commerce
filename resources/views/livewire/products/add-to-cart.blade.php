<x-container>
    <div class="card">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure>
                    <img src="{{ $product->image }}" class="aspect-[1/1] w-full object-cover object-center" alt="">
                </figure>
            </div>
            <div class="col-span-1">
                <h1 class="text-xl text-gray-600 mb-2">
                    {{ $product->name }}
                </h1>

                <div class="text-sm mb-2">
                    {{ $product->description }}
                </div>
                <div class="flex items-center space-x-2 mb-4">
                    <ul class="flex space-x-1 text-sm">
                        <li>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-700">4.5 (55)</p>
                </div>
                <p class="font-semibold text-2xl text-gray-600 mb-4">
                    $ {{ $product->price }}
                </p>
                <div class="flex items-center space-x-6 mb-6" x-data="{
                    qty: @entangle('qty'),
                }">
                    <button class="btn btn-gray" x-on:click="qty = qty - 1" x-bind:disabled="qty == 1">
                        -
                    </button>
                    <span class="inline-block w-2 text-center" x-text="qty"></span>
                    <button class="btn btn-gray" x-on:click="qty = qty + 1">
                        +
                    </button>
                </div>
                <div class="flex items-center space-x-4 text-gray-700 mb-6">
                    <i class="fa-solid fa-truck-fast text-2xl"></i>
                    <p>
                        Envío a domicilio
                    </p>
                </div>
                <button class="btn btn-purple w-full" wire:click="add_to_cart" wire:loading.attr="disabled">
                    Agregar al carrito
                </button>
            </div>
        </div>
    </div>
</x-container>
