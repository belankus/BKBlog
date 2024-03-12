{{-- Show Description --}}
<div class="w-full px-6">
    <div x-data="{ checked: @entangle('showDescription') }" class="rounded-lg border border-gray-300 px-6 pb-4 pt-2.5 shadow-md">
        <input type="checkbox" id="showDescription" wire:model.live="showDescription" x-model="checked" class="sr-only">
        <div class="flex w-full gap-4">
            <div class="flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path fill-rule="evenodd"
                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                        clip-rule="evenodd" />
                </svg>

            </div>
            <div class="flex w-full items-center justify-between">
                <div>
                    <h2 class="text-lg text-gray-500">Show Description</h2>
                    <p class="text-sm text-gray-500">Show description on your public profile</p>
                </div>
                <label for="showDescription" class="flex cursor-pointer items-center">
                    <div class="relative">
                        <div class="h-6 w-10 rounded-full bg-gray-400 shadow-inner transition-[color_500ms_ease-in]"
                            :class="{ 'bg-green-500': checked, 'bg-gray-400': !checked }"></div>
                        <div class="absolute inset-y-0 left-0 top-1/2 ms-1 flex h-4 w-4 -translate-y-1/2 items-center justify-center rounded-full bg-white transition-[translate_500ms_ease-in,_background-color_500ms_ease-in]"
                            :class="{
                                'translate-x-full bg-white shadow-lg': checked,
                                'translate-x-0 shadow-md bg-white': !
                                    checked
                            }">
                            <svg class="h-3 w-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                x-show="checked">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <p
            class="{{ $description && !$showDescription ? 'text-yellow-500' : 'hidden text-transparent' }} ms-10 text-sm">
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
            <textarea name="description" id="description" autocomplete="off" wire:model.live="description"
                placeholder="Tell us about yourself..."
                class="{{ $errors->has('description') ? 'border-pink-500 text-pink-500 focus:border-pink-500 focus:ring-pink-500' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500' }} block h-24 w-full resize-none rounded-lg border bg-gray-50 p-2.5 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"></textarea>
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
