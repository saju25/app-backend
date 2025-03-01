   <!-- Header Section -->






   <header >
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light w-100">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="/">
            <img src="{{ asset('assets/img/icon-logo-loding.png') }}" alt="" width="100px" height="50px">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end align-items-center gap-3">
                <li class="nav-item ">
                    <a class="nav-link" href="/">Accueil</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="{{route('shop.index')}}">Pharmacies</span></a>
                  </li>
                  @php
                  $user = auth()->user();
                @endphp
                @if ($user && $user->role == 'admin')
                <li class="nav-item ">
                 <a class="nav-link" href="{{route('admin_index')}}">Portail admin </span></a>
               </li>
                @endif
                 
                 @guest()
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Se connecter</a>
                  </li>
                  @endguest
              @auth()
         
               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-user "></i> {{auth()->user()->name}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link class="dropdown-item  text-center" :href="route('logout')"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                    this.closest('form').submit();">
                            {{ __('Se déconnecter') }}
                        </x-dropdown-link>
                    </form>
                  </li>
                </ul>
              </li>
              @endauth
          </div>
        </div>
      </nav>
    </div>
</header>