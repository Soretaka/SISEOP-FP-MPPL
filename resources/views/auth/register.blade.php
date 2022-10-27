<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- tempat tanggal lahir -->
            <div>
                <x-input-label for="tl" :value="__('Tanggal Lahir')" />

                <x-text-input id="tl" class="block mt-1 w-full" type="date" name="tl" :value="old('tl')" required autofocus />

                <x-input-error :messages="$errors->get('tl')" class="mt-2" />
            </div>
            <!-- Alamat -->
            <div>
                <x-input-label for="alamat" :value="__('Alamat')" />

                <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required autofocus />

                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>
            <!-- notelp -->
            <div>
                <x-input-label for="noTelp" :value="__('Nomor Handphone')" />

                <x-text-input id="noTelp" class="block mt-1 w-full" type="text" name="noTelp" :value="old('noTelp')" required autofocus />

                <x-input-error :messages="$errors->get('noTelp')" class="mt-2" />
            </div>
            <!-- nip -->
            <div>
                <x-input-label for="NIP" :value="__('NIP')" />

                <x-text-input id="NIP" class="block mt-1 w-full" type="text" name="NIP" :value="old('NIP')" required autofocus />

                <x-input-error :messages="$errors->get('NIP')" class="mt-2" />
            </div>
            <!-- jenis kelamin -->
            <div>
                <x-input-label for="JK" :value="__('Jenis Kelamin')" />
                <div>
                <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="JK" name="JK" required autofocus>
                    <option value="">-Pilih Jenis Kelamin-</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

                <x-input-error :messages="$errors->get('JK')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
