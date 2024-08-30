<div class="block fill-current text-gray-200 dark:text-gray-200 {{ $class ?? '' }}">

    @if(file_exists(public_path('app_assets/app_logo.png')))
        <img src="{{ asset('app_assets/app_logo.png') }}" class="w-100 h-20" alt="App Logo" />
    @else
        <img src="{{ asset('app_assets/default_logo.png') }}" class="w-100 h-20" alt="Default Logo" />
    @endif
</div>
