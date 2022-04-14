<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input 
                    id="name" class="block mt-1 w-full" 
                    type="text" name="name" :value="old('name')" required autofocus />
                @if($errors->has('name'))
                    <small class="text-red-600">
                        {{ $errors->first('name') }}
                    </small>
                @endif
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input 
                    id="email" class="block mt-1 w-full" 
                    type="email" name="email" :value="old('email')" required />
                @if($errors->has('email'))
                    <small class="text-red-600">
                        {{ $errors->first('email') }}
                    </small>
                @endif
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input 
                    id="password" class="block mt-1 w-full"
                    type="password" name="password"
                    required autocomplete="new-password" />
                @if($errors->has('password'))
                    <small class="text-red-600">
                        {{ $errors->first('password') }}
                    </small>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input 
                    id="password_confirmation" class="block mt-1 w-full"
                    type="password" name="password_confirmation" required />
                @if($errors->has('password_confirmation'))
                    <small class="text-red-600">
                        {{ $errors->first('password_confirmation') }}
                    </small>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
