<div x-data="{
    showModalImage: {{ $errors->any() ? 'true' : 'false' }},
    userData: {},
    details: {},
    openModalHeader(selectedTab) {
        this.showModalImage = true;
        document.body.style.overflow = 'hidden';
    },
    closeModalHeader() {
        this.showModalImage = false;
        document.body.style.overflow = 'auto';
    }
}" x-show="showModalImage"
    x-on:show-modal-image.window="openModalHeader(); userData = $event.detail.userData; details = $event.detail.details"
    x-cloak class="fixed left-0 top-0 z-[99] h-screen w-full overflow-y-scroll">
    {{-- Backdrop --}}
    <div x-show="showModalImage" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute inset-0 z-[99] h-fit min-h-screen w-full bg-[rgba(0,0,0,0.5)]">

        {{-- Modal --}}
        <div x-show="showModalImage" x-data x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90" x-cloak
            class="relative left-1/2 z-[100] my-20 flex h-[75vh] w-1/2 -translate-x-1/2 flex-col rounded-xl bg-zinc-50 py-4">
            <div class="relative mx-6 mb-5 flex justify-between">
                <h2 class="text-2xl font-bold text-gray-700">Edit Profile Photo</h2>
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
            <div class="h-full w-full px-6">
                <form wire:submit="save" class="flex h-full">
                    @csrf
                    <div class='flex h-full w-full gap-4'>
                        <div class="w-1/2">

                            <input id="profile_pic" wire:model="profile_pic" class="hidden" type="file">
                            @if (!$profile_pic)
                                <div
                                    class='flex h-full items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-100 p-4'>
                                    <label for="profile_pic"
                                        class="cursor-pointer rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Select
                                        Image</label>
                                </div>
                            @elseif ($profile_pic && is_object($profile_pic))
                                <div
                                    class="relative flex h-full items-center justify-center overflow-hidden rounded-lg border border-dashed border-gray-300 bg-gray-100 p-4">
                                    <img class="relative max-h-80 object-contain" wire:loading.attr="hidden"
                                        wire:target="profile_pic" src="{!! $profile_pic->temporaryUrl() !!}" alt="Preview Image"
                                        id="imagePreview">
                                </div>
                            @endif

                        </div>
                        <div class="flex w-1/2 flex-col justify-between">
                            <div>
                                @if ($profile_pic)
                                    <label for="profile_pic"
                                        class="cursor-pointer rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Select
                                        Image</label>
                                @endif
                            </div>
                            <div>
                                @error('profile_pic')
                                    <p class="mb-5 text-sm text-pink-500">
                                        <b>Warning!</b>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <button type="submit"
                                    class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                                    <div role="status" wire:loading wire:target="profile_pic"
                                        class="flex items-center gap-2">
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
                                    <span wire:loading.class="opacity-0 hidden" wire:target="profile_pic">Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
