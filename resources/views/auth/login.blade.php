<x-guest-layout>

<div class=" d-flex justify-content-center align-items-center mt-5">
    <div class="page section-header col-md-5 bg-white  mt-5 mb-4 p-4">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
             <div>
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
             <div class="d-flex justify-content-between align-items-center">
                <div class="block mt-4">
                    <label for="remember_me" class=" d-flex">
                        <input id="remember_me" type="checkbox" class="check_box" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Souviens-toi de moi') }}</span>
                    </label>
                </div>
                <div>
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
                </div>
             </div>
     
    
            <div class=" d-flex justify-content-end  mt-4">
             
    
                <x-primary-button class="btn">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

</x-guest-layout>
