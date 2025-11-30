<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @foreach(config('qf_laravel_ui.assets.css') as $cssFile)
            <link href="{{ asset($cssFile) }}" rel="stylesheet" />
        @endforeach


        @livewireStyles

        @stack('styles')
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        @stack('head-scripts')
    </head>


<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

  @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif
    <!--   Core JS Files   -->














 <!-- 1. Load Livewire -->
    @livewireScripts

    <!-- 2. Load Flatpickr library -->
    <script src="/assets/js/plugins/flatpickr.min.js"></script>

    <!-- 3. Register hook in global scope -->
    <script>
document.addEventListener('livewire:init', () => {


    function initFlatpickr() {
        if (typeof flatpickr === 'undefined') return;

        document.querySelectorAll('.datepicker').forEach(el => {
            if (el._flatpickr) el._flatpickr.destroy();
        });

        flatpickr('.datepicker', { dateFormat: "Y-m-d" });
        flatpickr('.datetimepicker', { enableTime: true, dateFormat: "Y-m-d H:i" });
        flatpickr('.timepicker', { enableTime: true, noCalendar: true, dateFormat: "H:i", time_24hr: true });
    }

    // Initialize on first load
    initFlatpickr();

    // ✅ CORRECT LIVEMIRE 3 HOOK
    Livewire.hook('morphed', ({ el, component }) => {

        initFlatpickr();
    });
});
    </script>


        @foreach(config('qf_laravel_ui.assets.js') as $jsFile)
            <script src="{{ asset($jsFile) }}"></script>
        @endforeach




<script>
    // Handle browser navigation (back/forward buttons)
    window.addEventListener('popstate', function(event) {
        if (event.state && event.state.page) {
            Livewire.dispatch('pageChanged', [event.state.page, event.state.params || {}]);
        }
    });

    // Listen for page changes from Livewire and update URL
    Livewire.on('page-changed', (data) => {
        // Update browser history without reloading
        history.pushState(
            { page: data.page, params: data.params },
            '',
            '/' + data.page
        );

        // Update document title if needed
        ///document.title = data.page.charAt(0).toUpperCase() + data.page.slice(1) + ' - ' + 'Your App Name';
    });
</script>

@stack('script')




    </body>
</html>

