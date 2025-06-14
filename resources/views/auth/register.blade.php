<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                placeholder="Nama anda" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                placeholder="contoh@gmail.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-password-input id="password" name="password" label="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-password-input id="password_confirmation" name="password_confirmation" label="Confirm Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="md:flex md:items-center md:justify-end mt-4">
            <a class=" text-sm text-gray-600 hover:text-[#E19B2C] rounded-md " href="{{ route('login') }}">
                {{ __('Sudah mempunyai akun?') }}
            </a>

            <x-primary-button class="w-full md:w-28 md:ms-4 text-center">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    @if (Session::has('message'))
        <script>
            swal("Message", "{{ Session::get('message') }}", 'success', {
                button:true,
                button:"OK"
            })
        </script>
    @endif
</x-guest-layout>
