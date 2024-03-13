<div x-data="{
    showModalHeader: false,
    activeTab: 'tabHeader',
    userData: {},
    details: {},
    openModalHeader(selectedTab) {
        this.showModalHeader = true;
        document.body.style.overflow = 'hidden';
        this.activeTab = selectedTab;
    },
    closeModalHeader() {
        this.showModalHeader = false;
        document.body.style.overflow = 'auto';
    }
}" x-show="showModalHeader"
    x-on:show-modal-header.window="openModalHeader(selectedTab = $event.detail.selectedTab); userData = $event.detail.userData; details = $event.detail.details"
    x-cloak class="fixed left-0 top-0 z-[99] h-screen w-full overflow-y-scroll">
    {{-- Backdrop --}}
    <div x-show="showModalHeader" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 z-[99] h-fit min-h-screen w-full bg-[rgba(0,0,0,0.5)]">

        {{-- Modal --}}
        <div x-show="showModalHeader" x-data x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90" x-cloak
            class="relative left-1/2 z-[100] my-20 flex h-[75vh] w-1/2 -translate-x-1/2 flex-col rounded-xl bg-zinc-50 py-4"
            @click.outside="closeModalHeader">
            <div class="relative mx-6 mb-5 flex justify-between">
                <h2 class="text-2xl font-bold text-gray-700">Edit Profile</h2>
                {{-- Close Button --}}
                <div class="relative">
                    <button type="button" @click="closeModalHeader"
                        class="rounded-lg p-2 focus:ring-2 focus:ring-blue-300 active:bg-zinc-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="relative h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>

            {{-- Nav Tab --}}
            <div class="mx-6 mb-5 flex border-b">
                <button
                    class="{{ $errors->has('name') || $errors->has('tagline') ? 'text-pink-500' : 'text-gray-500' }} flex items-center gap-2 px-4 py-2"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabHeader' }"
                    @click="activeTab = 'tabHeader'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>

                    Header
                </button>
                <button
                    class="{{ $errors->has('description') ? 'text-pink-500' : 'text-gray-500' }} flex items-center gap-2 px-4 py-2"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabDescription' }"
                    @click="activeTab = 'tabDescription'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path fill-rule="evenodd"
                            d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z"
                            clip-rule="evenodd" />
                    </svg>
                    Description
                </button>
                <button
                    class="{{ $errors->has('about') ? 'text-pink-500' : 'text-gray-500' }} flex items-center gap-2 px-4 py-2"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabAbout' }"
                    @click="activeTab = 'tabAbout'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                            d="M16.881 4.345A23.112 23.112 0 0 1 8.25 6H7.5a5.25 5.25 0 0 0-.88 10.427 21.593 21.593 0 0 0 1.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.593.772-2.468a17.116 17.116 0 0 1-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0 0 18 11.25c0-2.414-.393-4.735-1.119-6.905ZM18.26 3.74a23.22 23.22 0 0 1 1.24 7.51 23.22 23.22 0 0 1-1.41 7.992.75.75 0 1 0 1.409.516 24.555 24.555 0 0 0 1.415-6.43 2.992 2.992 0 0 0 .836-2.078c0-.807-.319-1.54-.836-2.078a24.65 24.65 0 0 0-1.415-6.43.75.75 0 1 0-1.409.516c.059.16.116.321.17.483Z" />
                    </svg>

                    About
                </button>
                <button
                    class="{{ $errors->has('location') || $errors->has('website') ? 'text-pink-500' : 'text-gray-500' }} flex items-center gap-2 px-4 py-2"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabLocation' }"
                    @click="activeTab = 'tabLocation'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path fill-rule="evenodd"
                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                            clip-rule="evenodd" />
                    </svg>

                    Location
                </button>
            </div>

            {{-- Form --}}
            <form wire:submit="save" class="h-full">

                @csrf
                <div class="flex h-full flex-col justify-between">
                    <div>
                        <div x-show="activeTab === 'tabHeader'">
                            <x-user.modal.header :name="$name" :tagline="$tagline" :user="$user"
                                :details="$details" />
                        </div>
                        <div x-show="activeTab === 'tabDescription'">
                            <x-user.modal.description :user="$user" :details="$details" :description="$description"
                                :showDescription="$showDescription" />
                        </div>
                        <div x-show="activeTab === 'tabAbout'">
                            <x-user.modal.about :user="$user" :details="$details" />
                        </div>
                        <div x-show="activeTab === 'tabLocation'">
                            Location </div>
                    </div>
                    <div>
                        <p class="ms-10 text-xs text-gray-500"><sup class="text-red-500">*</sup> Required</p>
                        <x-user.modal.footer :user="$user" />
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
