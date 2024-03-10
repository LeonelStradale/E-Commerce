<div>

    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="grid-cols-1 lg:col-span-5">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg">
                    Tienes un total de ({{ Cart::count() }}) productos en tu carrito de compras.
                </h1>

                <button class="font-semibold text-gray-600 hover:text-red-600" wire:click="destroy()">
                    Vaciar carrito
                </button>
            </div>
            <div class="card">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        <li class="lg:flex">
                            <img class="w-full lg:w-36 aspect-square object-cover object-center mr-2"
                                src="{{ $item->options->image }}" alt="">

                            <div class="w-80">
                                <p class="text-sm">
                                    <a href="{{ route('products.show', $item->id) }}">
                                        {{ $item->name }}
                                    </a>
                                </p>
                                <button
                                    class="flex justify-center items-center mt-1 bg-red-100 hover:bg-red-200 text-red-900 text-xs font-semibold rounded px-2.5 py-0.5"
                                    wire:click="remove('{{ $item->rowId }}')">
                                    <i class="fa-solid fa-xmark mr-0.5"></i>
                                    Quitar
                                </button>
                            </div>

                            <p>
                                $ {{ $item->price }}
                            </p>

                            <div class="ml-auto space-x-3">
                                <button class="btn btn-gray" wire:click="decrease('{{ $item->rowId }}')">
                                    -
                                </button>
                                <span class="inline-block
                                    w-2 text-center">
                                    {{ $item->qty }}
                                </span>
                                <button class="btn btn-gray" wire:click="increase('{{ $item->rowId }}')">
                                    +
                                </button>
                            </div>
                        </li>
                    @empty
                        <p class="text-center">
                            No hay productos en el carrito.
                        </p>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="grid-cols-1 lg:col-span-2">
            <div class="card">
                <div class="flex justify-between font-semibold mb-4">
                    <p>
                        Total:
                    </p>
                    <p>
                        $ {{ Cart::subtotal() }}
                    </p>
                </div>

                <a href="{{ route('shipping.index') }}" class="btn btn-purple block w-full text-center">
                    Continuar con la compra
                </a>

            </div>
        </div>
    </div>

</div>
