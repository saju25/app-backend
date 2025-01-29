<x-guest-layout>
    <div class=" p-4">
        <div class=" d-flex justify-content-center align-items-center">
        <div class="page section-header col-md-5 bg-white  mt-5 mb-4 p-4">
            <div class="page-title">
                <div class="wrapper text-bold text-center"><h1 class="page-width">Reset Password</h1></div>
            </div>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
        
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
        
                <div class=" d-flex justify-content-end mt-4 ">
                    <x-primary-button class="btn">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
    </div>

</x-guest-layout>
