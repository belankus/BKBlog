<div class="w-full px-6">
    <div x-data="{ checked: @entangle('isDescriptionActive') }">
        <input type="checkbox" id="toggle" wire:model="isDescriptionActive" x-model="checked" class="sr-only">

        <label for="toggle" class="flex cursor-pointer items-center">
            <div class="relative">
                <div class="h-6 w-10 rounded-full bg-gray-400 shadow-inner transition-[color_500ms_ease-in]"
                    :class="{ 'bg-green-500': checked, 'bg-gray-400': !checked }"></div>
                <div class="absolute inset-y-0 left-0 top-1/2 ms-1 flex h-4 w-4 -translate-y-1/2 items-center justify-center rounded-full bg-white transition-[translate_500ms_ease-in,_background-color_500ms_ease-in]"
                    :class="{ 'translate-x-full bg-white shadow-lg': checked, 'translate-x-0 shadow-md bg-white': !checked }">
                    <svg class="h-3 w-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        x-show="checked">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-3 font-medium text-gray-700" x-text="checked ? 'Active' : 'Inactive'"></div>
        </label>
    </div>
</div>
