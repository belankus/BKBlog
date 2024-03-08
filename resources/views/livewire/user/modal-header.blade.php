<div x-data="{ showModalHeader: false, userData: {}, details: {} }" x-show="showModalHeader"
    x-on:show-modal-header.window="showModalHeader = true; userData = $event.detail.userData; details = $event.detail.details"
    style="display: none;" x-transition.opacity
    class="position fixed left-0 top-0 z-[99] flex h-screen w-full items-center justify-center">
    {{-- Backdrop --}}
    <div class="absolute inset-0 z-[99] h-full w-full bg-black opacity-60">

    </div>
    <div x-transition x-show="showModalHeader" class="relative z-[100] w-1/2 rounded-xl bg-zinc-50 py-4 opacity-100"
        @click.outside="showModalHeader = false">
        <div class="relative mx-6 mb-5 flex justify-between border-b pb-5">
            <h2 class="text-2xl font-bold text-gray-700">Edit Profile</h2>
            {{-- Close Button --}}
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="relative h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>

        </div>
        <form wire:submit="save">

            @csrf

            <x-user.modal.header :name="$name" :tagline="$this->tagline" :user="$user" :details="$details" />

            <x-user.modal.footer />

        </form>
    </div>
</div>
