 {{-- Name --}}
 <div class="w-full px-6">
     <label for="name" class="mb-3 block text-base font-bold text-gray-700">Name <sup
             class="text-red-500">*</sup></label>
     <div class="w-full">

         <div class="relative">
             <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="{{ $errors->has('name') ? 'text-pink-500' : 'text-gray-500' }} h-4 w-4">
                     <path fill-rule="evenodd"
                         d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                         clip-rule="evenodd" />
                 </svg>

             </div>
             <input type="text" name="name" id="name" autocomplete="off" wire:model.live="name"
                 class="{{ $errors->has('name') ? 'border-pink-500 text-pink-500 focus:border-pink-500 focus:ring-pink-500' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500' }} block w-full rounded-lg border bg-gray-50 p-2.5 ps-10 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
         </div>
         <div>
             <p
                 class="{{ $errors->has('name') ? 'text-pink-500' : '' }} {{ !$errors->has('name') && $name ? 'text-green-500' : '' }} indent-1 text-sm">
                 <span
                     class="{{ $errors->has('name') || (!$errors->has('name') && $name !== $user->name) ? 'hidden' : 'text-transparent' }}">Placeholder</span>
                 @if (!$errors->has('name') && $name !== $user->name)
                     <b>Horay!</b>
                     <span>All looks pretty!</span>
                 @endif
                 @error('name')
                     <b>Warning!</b>
                     {{ $message }}
                 @enderror
             </p>
         </div>
     </div>

 </div>
 {{-- Tagline --}}
 <div class="mx-6 mt-2 border-t pt-3">
     <label for="tagline" class="mb-2 block text-base font-bold text-gray-700">Tagline</label>
     <div class="relative">
         <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">

             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="{{ $errors->has('tagline') ? 'text-pink-500' : 'text-gray-500' }} h-4 w-4">
                 <path fill-rule="evenodd"
                     d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 0 1-.375.65 2.249 2.249 0 0 0 0 3.898.75.75 0 0 1 .375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 17.625v-3.026a.75.75 0 0 1 .374-.65 2.249 2.249 0 0 0 0-3.898.75.75 0 0 1-.374-.65V6.375Zm15-1.125a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0v.75a.75.75 0 0 0 1.5 0v-.75Zm-.75 3a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0v-.75a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75ZM6 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z"
                     clip-rule="evenodd" />
             </svg>


         </div>
         <input type="text" name="tagline" id="tagline" autocomplete="off" wire:model.live="tagline"
             class="{{ $errors->has('tagline') ? 'border-pink-500 text-pink-500 focus:border-pink-500 focus:ring-pink-500' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500' }} block w-full rounded-lg border bg-gray-50 p-2.5 ps-10 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
     </div>
     <div>
         @if ($tagline)
             <p
                 class="{{ $errors->has('tagline') ? 'text-pink-500' : '' }} {{ !$errors->has('tagline') && $tagline ? 'text-green-500' : '' }} indent-1 text-sm">
                 <span
                     class="{{ $errors->has('tagline') || (!$errors->has('tagline') && $tagline !== $details->tagline && $tagline) ? 'hidden' : 'text-transparent' }}">Placeholder</span>
                 @if (!$errors->has('tagline') && $tagline !== $details->tagline && $tagline)
                     <b>Horay!</b>
                     <span>All looks pretty!</span>
                 @endif
                 @error('tagline')
                     <b>Warning!</b>
                     {{ $message }}
                 @enderror
             </p>
         @endif
     </div>
 </div>
