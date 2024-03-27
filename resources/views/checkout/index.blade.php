<x-app-layout>

    <x-container>
        <div class="-mb-16 text-gray-700" x-data="{
            pago: 1,
        }">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="col-span-1">
                    <div class="lg:max-w-[40rem] py-12 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                        <h1 class="text-2xl font-semibold mb-2">
                            Método de pago
                        </h1>
                        <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                            <ul class="divide-y divide-gray-400">
                                <!-- TDCyB -->
                                <li>
                                    <label class="p-4 flex items-center bg-white">
                                        <input type="radio" x-model="pago" value="1">
                                        <span class="ml-2">
                                            Tarjeta de crédito o débito
                                        </span>
                                        <img class="h-6 ml-auto object-cover object-center"
                                            src="{{ asset('img/payments.png') }}" alt="">
                                    </label>
                                    <div class="p-4 bg-gray-200 text-center border-t border-gray-400"
                                        x-show="pago == 1">
                                        <i class="fa-regular fa-credit-card text-9xl"></i>
                                        <p class="mt-2">
                                            Luego de hacer clic al "Pagar ahora", se abrirá el checkout de Stripe para
                                            completar tú compra de forma segura.
                                        </p>
                                    </div>
                                </li>
                                <!-- PayPal -->
                                <li>
                                    <label class="p-4 flex items-center bg-white">
                                        <input type="radio" x-model="pago" value="2">
                                        <span class="ml-2">
                                            PayPal
                                        </span>
                                        <img class="h-5 ml-auto object-cover object-center"
                                            src="{{ asset('img/paypal.png') }}" alt="">
                                    </label>
                                    <div class="p-4 bg-gray-200 text-center border-t border-gray-400" x-cloak
                                        x-show="pago == 2">
                                        <i class="fa-brands fa-paypal text-9xl"></i>
                                        <p class="mt-2">
                                            Luego de hacer clic al "Pagar ahora", se abrirá el checkout de PayPal para
                                            completar tú compra de forma segura.
                                        </p>
                                    </div>
                                </li>
                                <!-- Transferencia -->
                                <li>
                                    <label class="p-4 flex items-center">
                                        <input type="radio" x-model="pago" value="3">
                                        <span class="ml-2">
                                            Deposito bancario
                                        </span>
                                    </label>
                                    <div class="p-4 bg-gray-200 flex justify-center border-t border-gray-400" x-cloak
                                        x-show="pago == 3">
                                        <div>
                                            <p>
                                                1. Pago por déposito o transferencia bancaria:
                                            </p>
                                            <p>
                                                - Banco: Banorte
                                            </p>
                                            <p>
                                                - Clave: 1234567890
                                            </p>
                                            <p>
                                                2. Pago por déposito vía OXXO:
                                            </p>
                                            <p>
                                                - Clave: 1234567890
                                            </p>
                                            <p>
                                                - Enviar el comprobante de pago al número 4922951793
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="lg:max-w-[40rem] py-12 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                        <ul class="space-y-4 mb-4">
                            @foreach (Cart::instance('shopping')->content() as $item)
                                <li class="flex items-center space-x-4">
                                    <div class="flex-shrink-0 relative">
                                        <img class="h-16 aspect-square" src="{{ $item->options->image }}"
                                            alt="">
                                        <div
                                            class="flex justify-center items-center h-6 w-6 bg-purple-500 bg-opacity-70 rounded-full absolute -right-2 -top-2 text-xs text-white border-2 border-white font-bold">
                                            <span class="text-white font-semibold">
                                                {{ $item->qty }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p>
                                            {{ $item->name }}
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p>
                                            $ {{ $item->price }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="flex justify-between">
                            <p>
                                Subtotal:
                            </p>
                            <p>
                                $ {{ Cart::instance('shopping')->subtotal() }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p>
                                IVA (16%):
                            </p>
                            <p>
                                $ {{ Cart::instance('shopping')->tax() }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p>
                                Precio de envío:
                                <i class="fas fas-info-circle" title="El precio de envío es de $50.00 pesos"></i>
                            </p>
                            <p>
                                $ 50.00
                            </p>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between mb-4">
                            <p class="text-lg font-semibold">
                                Total:
                            </p>
                            <p>
                                $ {{ (float) preg_replace('/[^0-9.]/', '', Cart::instance('shopping')->total()) + 50 }}
                            </p>
                        </div>
                        <form action="{{ route('checkout.paypal') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-purple w-full block bg-inherit">
                                Realizar pedido
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-container>

</x-app-layout>
