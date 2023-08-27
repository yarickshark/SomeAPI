<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

{{--}}@extends('layout')

@section('title')Головна сторінка@endsection

@section('main_content')
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; bg-dark;">
    --}}
        <form method="POST" action="{{ route('login') }}" {{--style="width: 100%; max-width: 400px; padding: 20px; background-color: darkslategrey; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);"--}}>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Електронна пошта')" /><br>
            <x-text-input id="email" style="width: 100%;" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" /><br>

            <x-text-input id="password" style="width: 100%;"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Запам`ятати мене') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Забули пароль?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 bg-dark">
                {{ __('Увійти') }}
            </x-primary-button>
        </div>
    </form>
{{--</div>--}}
</x-guest-layout>
{{--@endsection--}}
