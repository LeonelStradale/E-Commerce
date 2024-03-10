<x-guest-layout>
    <x-authentication-card width="sm:max-w-2xl">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-label for="last_name" value="{{ __('Last name') }}" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                        required autocomplete="last_name" />
                </div>

                <!-- Document Type -->
                {{-- <div>
                    <x-label for="document_type" value="{{ __('Document type') }}" />
                    <x-select id="document_type" class="w-full">
                        <option value="1">CURP</option>
                        <option value="2">RFC</option>
                        <option value="3">ID</option>
                    </x-select>
                </div> --}}


                <!-- Document -->
                {{-- <div>
                    <x-label for="document_number" value="{{ __('Document') }}" />
                    <x-input id="document_number" class="block mt-1 w-full" type="text" name="document_number"
                        :value="old('document_number')" required />
                </div> --}}

                <!-- Email -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                </div>

                <!-- Phone -->
                <div>
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')"
                        required />
                </div>

                <!-- Password -->
                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Recaptcha -->
                <div>
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4" type="button" onclick="onClick(event)"
                    data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback='onSubmit'
                    data-action='register'>
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    @push('script')
        <script>
            function onClick(e) {
                e.preventDefault();
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                        action: 'register'
                    }).then(function(token) {
                        document.getElementById("g-recaptcha-response").value = token;
                        document.getElementById("registerForm").submit();
                    });
                });
            }
        </script>
    @endpush

</x-guest-layout>
