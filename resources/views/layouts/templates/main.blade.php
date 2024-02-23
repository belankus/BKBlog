@include('layouts.templates.head')

<body>
    <div class="bg-white">
        {{-- Navbar --}}
        @include('layouts.templates.navbar')

        <div class="relative isolate px-6 pt-14 lg:px-8">
            {{-- Blob Warna Warni --}}
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            {{-- Hero Section --}}
            @yield('content')


            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
        {{-- <footer class="relative bg-gray-50 dark:bg-gray-800 antialiased"> --}}
        <footer class="relative mt-28 antialiased lg:mt-16">
            <div class="mx-auto max-w-screen-xl p-4 py-6 md:p-8 lg:p-10">
                <div class="text-center">
                    <span class="block text-center text-sm text-gray-500 dark:text-gray-400">© 2024 <a
                            href="https://bellawan.my.id" target="_blank" class="hover:underline">BKA™</a>. All Rights
                        Reserved.
                    </span>
                    <ul class="mt-5 flex justify-center space-x-5">
                        <li>
                            <a href="https://twitter.com/belankus" target="_blank" title="X Twitter Profile">
                                <span class="sr-only">X Twitter</span>
                                <div class="group relative overflow-hidden rounded-full bg-transparent p-2">

                                    <svg class="relative z-[2] h-4 w-4 text-gray-500 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M13.8 10.5 20.7 2h-3l-5.3 6.5L7.7 2H1l7.8 11-7.3 9h3l5.7-7 5.1 7H22l-8.2-11.5Zm-2.4 3-1.4-2-5.6-7.9h2.3l4.5 6.3 1.4 2 6 8.5h-2.3l-4.9-7Z" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/bellawankusuma/" target="_blank"
                                title="LinkedIn Profile">
                                <span class="sr-only">Linked In</span>
                                <div class="group relative overflow-hidden rounded-full bg-transparent p-2">

                                    <svg class="relative z-[2] h-4 w-4 text-gray-500 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12.5 8.8v1.7a3.7 3.7 0 0 1 3.3-1.7c3.5 0 4.2 2.2 4.2 5v5.7h-3.2v-5c0-1.3-.2-2.8-2.1-2.8-1.9 0-2.2 1.3-2.2 2.6v5.2H9.3V8.8h3.2ZM7.2 6.1a1.6 1.6 0 0 1-2 1.6 1.6 1.6 0 0 1-1-2.2A1.6 1.6 0 0 1 6.6 5c.3.3.5.7.5 1.1Z"
                                            clip-rule="evenodd" />
                                        <path d="M7.2 8.8H4v10.7h3.2V8.8Z" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/belankus/" target="_blank" title="GitHub Profile">
                                <span class="sr-only">Github</span>
                                <div class="group relative overflow-hidden rounded-full bg-transparent p-2">

                                    <svg class="relative z-[2] h-4 w-4 text-gray-500 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 2c-2.4 0-4.7.9-6.5 2.4a10.5 10.5 0 0 0-2 13.1A10 10 0 0 0 8.7 22c.5 0 .7-.2.7-.5v-2c-2.8.7-3.4-1.1-3.4-1.1-.1-.6-.5-1.2-1-1.5-1-.7 0-.7 0-.7a2 2 0 0 1 1.5 1.1 2.2 2.2 0 0 0 1.3 1 2 2 0 0 0 1.6-.1c0-.6.3-1 .7-1.4-2.2-.3-4.6-1.2-4.6-5 0-1.1.4-2 1-2.8a4 4 0 0 1 .2-2.7s.8-.3 2.7 1c1.6-.5 3.4-.5 5 0 2-1.3 2.8-1 2.8-1 .3.8.4 1.8 0 2.7a4 4 0 0 1 1 2.7c0 4-2.3 4.8-4.5 5a2.5 2.5 0 0 1 .7 2v2.8c0 .3.2.6.7.5a10 10 0 0 0 5.4-4.4 10.5 10.5 0 0 0-2.1-13.2A9.8 9.8 0 0 0 12 2Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/belankus/" target="_blank" title="Instagram Profile">
                                <span class="sr-only">Instagram</span>
                                <div class="group relative overflow-hidden rounded-full bg-transparent p-2">

                                    <svg class="relative z-[2] h-4 w-4 text-gray-500" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <script>
        const nav = document.getElementById('navbar');
        const header = document.getElementById('pseudo-navbar');
        const navHeight = nav.getBoundingClientRect().height;

        function updateNavColor(entries) {
            const [entry] = entries;
            if (!entry.isIntersecting) {
                nav.classList.add('bg-white', 'shadow');
                // nav.classList.remove("transparan");

            } else {
                // nav.classList.add("transparan");
                nav.classList.remove('bg-white', 'shadow');
            }

        }

        const headerObserver = new IntersectionObserver(updateNavColor, {
            root: null,
            threshold: 0,
            rootMargin: `-${navHeight}px`
        });

        headerObserver.observe(header)
    </script>
</body>

</html>
