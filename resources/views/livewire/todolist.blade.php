<!-- todo-list.blade.php -->
<div>

    <div class="@error('description') shadow-pink-600 @enderror relative mt-2 rounded-md shadow-sm">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <span class="text-gray-500 sm:text-sm">?</span>
        </div>
        <input type="text"
            class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Type something" name="description" wire:model="description" wire:keydown.enter="addTodo">
        <div class="absolute inset-y-0 right-0 flex items-center">
            <select
                class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                name="category" wire:model="category" id="category" wire:keydown.enter="addTodo">
                <option value="Frontend">Frontend</option>
                <option value="Backend">Backend</option>
                <option value="Content">Content</option>
            </select>

        </div>
    </div>
    @error('description')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
    <button class="mt-2 rounded bg-blue-700 px-3 py-1.5 text-sm text-white" wire:click="addTodo">Add Todo</button>
    @foreach ($todos as $index => $todo)
        <div class="my-2 flex justify-between rounded bg-green-300 px-4 py-2" wire:key="todo-{{ $index }}">
            <div>
                <span class="font-bold">{{ $todos[$index]['category'] }}</span>
                <p>{{ $todos[$index]['description'] }}</p>
            </div>
            <button wire:click="removeTodo({{ $index }})">Remove</button>
        </div>
    @endforeach
</div>
