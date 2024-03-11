{{-- Show Description --}}
<div class="w-full px-6">
    <div x-data="{ checked: @entangle('showDescription') }">
        <input type="checkbox" id="toggle" wire:model.live="showDescription" x-model="checked" class="sr-only">
        <div class="flex w-full items-center justify-between">
            <p class="text-gray-500">Show description on your public profile</p>
            <label for="toggle" class="flex cursor-pointer items-center">
                <div class="relative">
                    <div class="h-6 w-10 rounded-full bg-gray-400 shadow-inner transition-[color_500ms_ease-in]"
                        :class="{ 'bg-green-500': checked, 'bg-gray-400': !checked }"></div>
                    <div class="absolute inset-y-0 left-0 top-1/2 ms-1 flex h-4 w-4 -translate-y-1/2 items-center justify-center rounded-full bg-white transition-[translate_500ms_ease-in,_background-color_500ms_ease-in]"
                        :class="{ 'translate-x-full bg-white shadow-lg': checked, 'translate-x-0 shadow-md bg-white': !checked }">
                        <svg class="h-3 w-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            x-show="checked">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                </div>
            </label>
        </div>
        <p class="{{ $description && !$showDescription ? 'text-yellow-500' : 'text-transparent' }} text-sm">
            <b>Notice!</b>
            <span>Please turn the switch on to make visible in public!</span>
        </p>
    </div>
</div>

{{-- Description --}}
<div class="mx-6 mt-2 pt-3">
    <label for="name" class="mb-3 block text-base font-bold text-gray-700">Description</label>
    <div class="w-full">

        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="{{ $errors->has('description') ? 'text-pink-500' : 'text-gray-500' }} h-4 w-4">
                    <path fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <textarea name="description" id="description" autocomplete="off" wire:model.live="description"
                class="{{ $errors->has('description') ? 'border-pink-500 text-pink-500 focus:border-pink-500 focus:ring-pink-500' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500' }} block h-24 w-full resize-none rounded-lg border bg-gray-50 p-2.5 ps-10 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"></textarea>
        </div>
        <div>
            <p
                class="{{ $errors->has('description') ? 'text-pink-500' : '' }} {{ !$errors->has('description') && $description ? 'text-green-500' : '' }} indent-1 text-sm">
                <span
                    class="{{ $errors->has('description') || (!$errors->has('description') && $description !== $details->description) ? 'hidden' : 'text-transparent' }}">Placeholder</span>
                @if (!$errors->has('description') && $description !== $details->description && $description)
                    <b>Horay!</b>
                    <span>All looks pretty!</span>
                @endif
                @error('description')
                    <b>Warning!</b>
                    {{ $message }}
                @enderror
            </p>
        </div>
    </div>

</div>
