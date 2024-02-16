@extends('layouts.templates.main')

@section('content')
    <main class="pb-16 pt-8 antialiased dark:bg-gray-900 lg:pb-24 lg:pt-16">
        <div class="mx-auto flex max-w-screen-xl justify-between px-4">
            <article
                class="format format-sm format-blue mx-auto w-full max-w-2xl dark:format-invert sm:format-base lg:format-lg">
                <header class="not-format mb-4 lg:mb-6">
                    <address class="mb-6 flex items-center not-italic">
                        <div class="mr-3 inline-flex items-center text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 h-16 w-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div>
                                <a href="#" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white">{{ $singlePost->user->name }}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO
                                    Flowbite</p>
                                <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">Feb. 8, 2022</time></p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 dark:text-white lg:mb-6 lg:text-4xl">
                        {{ $singlePost->title }}</h1>
                </header>
                {{ $singlePost->content }}

                @include('layouts.blog.comment')
            </article>
        </div>
    </main>

    <aside aria-label="Related
                                articles" class="bg-gray-50 py-8 dark:bg-gray-800 lg:py-24">
        <div class="mx-auto max-w-screen-xl px-4">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png"
                            class="mb-5 rounded-lg" alt="Image 1">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">Our first office</a>
                    </h2>
                    <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft
                        has undergone many
                        changes! After months of preparation.</p>
                    <a href="#"
                        class="inline-flex items-center font-medium text-primary-600 underline underline-offset-4 hover:no-underline dark:text-primary-500">
                        Read in 2 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png"
                            class="mb-5 rounded-lg" alt="Image 2">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">Enterprise design tips</a>
                    </h2>
                    <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft
                        has undergone many
                        changes! After months of preparation.</p>
                    <a href="#"
                        class="inline-flex items-center font-medium text-primary-600 underline underline-offset-4 hover:no-underline dark:text-primary-500">
                        Read in 12 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png"
                            class="mb-5 rounded-lg" alt="Image 3">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">We partnered with Google</a>
                    </h2>
                    <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft
                        has undergone many
                        changes! After months of preparation.</p>
                    <a href="#"
                        class="inline-flex items-center font-medium text-primary-600 underline underline-offset-4 hover:no-underline dark:text-primary-500">
                        Read in 8 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png"
                            class="mb-5 rounded-lg" alt="Image 4">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">Our first project with React</a>
                    </h2>
                    <p class="mb-4 text-gray-500 dark:text-gray-400">Over the past year, Volosoft
                        has undergone many
                        changes! After months of preparation.</p>
                    <a href="#"
                        class="inline-flex items-center font-medium text-primary-600 underline underline-offset-4 hover:no-underline dark:text-primary-500">
                        Read in 4 minutes
                    </a>
                </article>
            </div>
        </div>
    </aside>

    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
            <div class="mx-auto max-w-screen-md sm:text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Sign up
                    for our newsletter</h2>
                <p class="mx-auto mb-8 max-w-2xl text-gray-500 dark:text-gray-400 sm:text-xl md:mb-12">
                    Stay up to date
                    with the roadmap progress, announcements and exclusive discounts feel free
                    to sign up with your email.
                </p>
                <form action="#">
                    <div class="mx-auto mb-3 max-w-screen-sm items-center space-y-4 sm:flex sm:space-y-0">
                        <div class="relative w-full">
                            <label for="email"
                                class="mb-2 hidden text-sm font-medium text-gray-900 dark:text-gray-300">Email
                                address</label>
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                            </div>
                            <input
                                class="block w-full rounded-lg border border-gray-300 bg-white p-3 pl-9 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:rounded-none sm:rounded-l-lg"
                                placeholder="Enter your email" type="email" id="email" required="">
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full cursor-pointer rounded-lg border border-primary-600 bg-primary-700 px-5 py-3 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:rounded-none sm:rounded-r-lg">Subscribe</button>
                        </div>
                    </div>
                    <div
                        class="newsletter-form-footer mx-auto max-w-screen-sm text-left text-sm text-gray-500 dark:text-gray-300">
                        We care about the protection of your data. <a href="#"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Read
                            our Privacy
                            Policy</a>.</div>
                </form>
            </div>
        </div>
    </section>
@endsection
