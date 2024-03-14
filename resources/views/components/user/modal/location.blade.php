 {{-- Location --}}
 <div class="w-full px-6">
     <label for="location" class="mb-3 block text-base font-bold text-gray-700">Location</label>
     <div class="w-full">

         <div class="relative">
             <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="{{ $errors->has('location') ? 'text-pink-500' : 'text-gray-500' }} h-4 w-4">
                     <path fill-rule="evenodd"
                         d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                         clip-rule="evenodd" />
                 </svg>

             </div>
             <input type="text" name="location" id="location" autocomplete="off" wire:model.live="location"
                 placeholder="Jakarta, Indonesia"
                 class="{{ $errors->has('location') ? 'border-pink-500 text-pink-500 focus:border-pink-500 focus:ring-pink-500' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500' }} block w-full rounded-lg border bg-gray-50 p-2.5 ps-10 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
         </div>
         <div>
             <p
                 class="{{ $errors->has('location') ? 'text-pink-500' : '' }} {{ !$errors->has('location') && $location ? 'text-green-500' : '' }} indent-1 text-sm">
                 <span
                     class="{{ $errors->has('location') || (!$errors->has('location') && $location !== $details->location) ? 'hidden' : 'text-transparent' }}">Placeholder</span>
                 @if (!$errors->has('location') && $location !== $details->location)
                     <b>Horay!</b>
                     <span>All looks pretty!</span>
                 @endif
                 @error('location')
                     <b>Warning!</b>
                     {{ $message }}
                 @enderror
             </p>
         </div>
     </div>

 </div>

 {{-- Website --}}
 <div class="mx-6 mt-2 border-t pt-3">
     <label for="website" class="mb-2 block text-base font-bold text-gray-700">Website</label>
     <div class="relative">
         <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
             <span class="{{ $errors->has('website') ? 'text-pink-500' : 'text-gray-500' }} text-sm">https://</span>



         </div>
         <input type="text" name="website" id="website" autocomplete="off" wire:model.live="website"
             placeholder="yourwebsite.com"
             class="{{ $errors->has('website') ? 'border-pink-500 text-pink-500 focus:border-pink-500 focus:ring-pink-500' : 'border-gray-300 text-gray-900 focus:border-blue-500 focus:ring-blue-500' }} block w-full rounded-lg border bg-gray-50 p-2.5 ps-16 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
     </div>
     <div>
         <p
             class="{{ $errors->has('website') ? 'text-pink-500' : '' }} {{ !$errors->has('website') && $website ? 'text-green-500' : '' }} indent-1 text-sm">
             <span
                 class="{{ $errors->has('website') || (!$errors->has('website') && $website !== $details->website && $website) ? 'hidden' : 'text-transparent' }}">Placeholder</span>
             @if (!$errors->has('website') && $website !== $details->website && $website)
                 <b>Horay!</b>
                 <span>All looks pretty!</span>
             @endif
             @error('website')
                 <b>Warning!</b>
                 {{ $message }}
             @enderror
         </p>
     </div>
 </div>


 {{-- Email --}}
 <div class="mx-6 mt-2 border-t pt-3">
     <h2 class="mb-2 block text-base font-bold text-gray-700">Email</h2>
     <p class="text-sm text-gray-500">Edit your email preferences at <a href="#"
             class="text-blue-500 underline hover:text-blue-600 hover:no-underline">Account Settings</a></p>
 </div>
