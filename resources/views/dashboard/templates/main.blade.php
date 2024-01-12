@include('dashboard.templates.head')

@include('dashboard.templates.navbar')

<div class="flex overflow-hidden pt-16 bg-gray-100 min-h-screen">
    @include('dashboard.templates.sidebar')
    <div id="contentSection" class="relative w-full h-full sm:ml-64 transition-all duration-500">
        <main>
            @include('dashboard.templates.navbread')
            @yield('content')
        </main>
    </div>
</div>
@include('dashboard.templates.footer')
