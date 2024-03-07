<div x-data="{ showModalHeader: false, userData: {}, details: {} }" x-show="showModalHeader"
    x-on:show-modal-header.window="showModalHeader = true; userData = $event.detail.userData; details = $event.detail.details"
    style="display: none;" x-transition.opacity
    class="position fixed left-0 top-0 z-[99] flex h-screen w-full items-center justify-center">
    {{-- Backdrop --}}
    <div class="absolute inset-0 z-[99] h-full w-full bg-black opacity-60">

    </div>
    <div x-transition x-show="showModalHeader" class="relative z-[100] w-1/2 rounded-lg bg-zinc-50 px-10 py-6 opacity-100"
        @click.outside="showModalHeader = false">
        <h2 class="mb-5 border-b pb-5 text-2xl font-bold text-gray-700">Edit Name</h2>
        <form wire:submit="save">
            @csrf
            {{-- Name --}}
            <div class="w-1/2">
                <label for="name" class="mb-2 block text-base font-bold text-gray-700">Name <sup
                        class="text-red-500">*</sup></label>
                <input type="text" name="name" id="name" autocomplete="off" wire:model="name"
                    class="w-full rounded-lg border-2 border-gray-200 bg-gray-100 px-3 py-1.5 text-gray-500 shadow-inner">
                @error('name')
                    <span class="text-pink-500">{{ $message }}</span>
                @enderror
            </div>
            {{-- Tagline --}}
            <div class="mt-6 w-full">
                <label for="tagline" class="mb-2 block text-base font-bold text-gray-700">Tagline</label>
                <input type="text" name="tagline" id="tagline" autocomplete="off" wire:model="tagline"
                    class="w-full rounded-lg border-2 border-gray-200 bg-gray-100 px-3 py-1.5 text-gray-500 shadow-inner">
                @error('tagline')
                    <span class="text-pink-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-6 flex w-full justify-end gap-4 border-t pt-6">

                <div class="flex w-fit justify-end">
                    <button type="button" wire:click="save" wire:loading.attr="disabled"
                        wire:loading.class="hover:cursor-not-allowed"
                        class="rounded-lg bg-blue-700 px-3 py-1.5 text-white hover:bg-blue-800">
                        <div role="status" wire:loading wire:target="save" class="flex items-center gap-2">
                            <svg aria-hidden="true"
                                class="inline h-3 w-3 animate-spin fill-blue-600 text-white dark:text-gray-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span>Loading...</span>
                        </div>
                        <span wire:loading.class="opacity-0 hidden" wire:target="save">Save</span>
                    </button>
                </div>
                <div class="flex w-fit justify-end">
                    <button type="button" @click="showModalHeader = false"
                        class="rounded-lg bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">Cancel</button>

                </div>
            </div>

        </form>
    </div>
</div>
