<x-guest-layout>

    <div class=" d-flex justify-content-center align-items-center">
            <div class=" page section-header col-md-5 bg-white  mt-5 mb-4 p-4">
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
            
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
            
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
            
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <div class=" d-flex justify-content-end mt-4">
                        <x-primary-button class="btn">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
    </div>
 

   {{-- <div class="page section-header text-center mt-5 mb-4">
        <div class="page-title">
            <div class="wrapper text-bold"><h1 class="page-width">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</h1></div>
          </div>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-5 bg-white p-4">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-grou  mt-3 mb-3">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email" name="email" :value="old('email')" required autofocus autocomplete="username">
                </div>
        
                 <div class="d-flex justify-content-end align-items-center mt-3 mb-3">
                    <button type="submit" class="btn btn-1">Submit</button>
                 </div>
              
              </form>
        </div> 
    
    </div>  --}}
     
</x-guest-layout>
