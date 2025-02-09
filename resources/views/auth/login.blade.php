<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <h1 class="text-xl font-bold text-center">Aplikasi Pengelolaan Barang</h1>
            <h2 class="text-sm font-bold text-center">PT JMC Indonesia</h2>
            <hr class="mt-4">
            <h2 class="text-xl font-bold mt-4">Login</h2>
            <p>Selamat datang, silakan masukan username dan password anda! </p>
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" min="8" max="100" name="username" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 text-sm">
            <i>*username = admin, password = Aldi1234</i>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3 text-center">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
