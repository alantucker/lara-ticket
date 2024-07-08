<form wire:submit="save">
    @csrf
    <div>
        <label for="body" class="sr-only">Reply</label>
        <textarea wire:model="body" id="body" name="body" rows="3" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Your reply"></textarea>
        @error('body') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
    </div>
    <div class="mt-3 flex items-center justify-between">
        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Add Reply</button>
    </div>
</form>
