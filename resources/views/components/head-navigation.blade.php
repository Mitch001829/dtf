

<nav id="header" class="bg-white fixed w-full z-30 top-0 text-white">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">

        <div onclick="window.location.href='/'">
            <x-application-logo />
        </div>


      <div class="block lg:hidden pr-4">
        <button id="nav-toggle" class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
          <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <title>Menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
          </svg>
        </button>
      </div>
      <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
        
          @if (Route::has('login'))
              <nav class="-mx-3 flex flex-1 justify-end">

                    <a
                        href="{{ url('/') }}"
                        class="font-bold text-black px-2">
                        Home
                    </a>

                    {{-- <a
                        href="{{ url('/dashboard') }}"
                        class="font-bold text-black px-2 bg-gray">
                        About Us
                    </a>
                    <a
                        href="{{ url('/dashboard') }}"
                        class="font-bold text-black px-2">
                        Services
                    </a> --}}
                  @auth
                      <a
                          href="{{ url('/dashboard') }}"
                          class="font-bold text-black">
                          Dashboard
                      </a>
                  @else
                      <a
                          href="{{ route('login') }}"
                          class="font-bold text-black px-2">
                          Log in
                      </a>

                      @if (Route::has('register'))
                          <a
                              href="{{ route('public.register') }}"
                              class="font-bold text-black px-2">
                              Register
                          </a>
                      @endif
                  @endauth
              </nav>
          @endif
      </div>
    </div>
    <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
  </nav>