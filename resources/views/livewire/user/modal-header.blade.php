<div x-data="{
    showModalHeader: true,
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
                    <button type="button" class="rounded-lg p-2 focus:ring-2 focus:ring-blue-300 active:bg-zinc-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="relative h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>

            {{-- Nav Tab --}}
            <div class="mx-6 mb-5 flex border-b">
                <button class="px-4 py-2 text-gray-500"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabHeader' }"
                    @click="activeTab = 'tabHeader'">
                    Header
                </button>
                <button class="px-4 py-2 text-gray-500"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabDescription' }"
                    @click="activeTab = 'tabDescription'">
                    Description
                </button>
                <button class="px-4 py-2 text-gray-500"
                    :class="{ 'border-b-2 border-blue-600 text-gray-800': activeTab === 'tabAbout' }"
                    @click="activeTab = 'tabAbout'">
                    About
                </button>
            </div>

            {{-- Form --}}
            <form wire:submit="save" class="h-full">

                @csrf
                <div class="flex h-full flex-col justify-between">
                    <div>
                        <div x-show="activeTab === 'tabHeader'">
                            <x-user.modal.header :name="$name" :tagline="$this->tagline" :user="$user"
                                :details="$details" />
                        </div>
                        <div x-show="activeTab === 'tabDescription'">
                            <x-user.modal.description :user="$user" :details="$details" :isDescriptionActive="$isDescriptionActive" />
                        </div>
                        <div x-show="activeTab === 'tabAbout'">
                            <x-user.modal.about :user="$user" :details="$details" />
                        </div>
                    </div>
                    <x-user.modal.footer :user="$user" />
                </div>
            </form>
        </div>
    </div>

</div>
