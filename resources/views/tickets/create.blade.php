<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow sm:overflow-hidden sm:rounded-md">

                <form action="{{ route('ticket.store') }}" method="post">
                    @csrf
                    <div class="space-y-6 bg-white px-4 py-6 sm:p-6">
                        <div>
                            <h3 class="text-base font-semibold leading-6 text-gray-900">New Ticket</h3>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Subject <span class="text-xs text-red-500">* @error('subject') Required @enderror</span></label>
                                <input type="text" name="subject" id="subject" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ old('subject') }}">
                            </div>
                            <div class="col-span-6">
                                <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Information <span class="text-xs text-red-500">* @error('body') Required @enderror</span></label>
                                <textarea id="body" name="body" rows="3" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('body') }}</textarea>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category <span class="text-xs text-red-500">* @error('category') Required @enderror</span></label>
                                <select id="category" name="category" class="mt-2 block w-full rounded-md border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('category') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="priority" class="block text-sm font-medium leading-6 text-gray-900">Priority <span class="text-xs text-red-500">* @error('priority') Required @enderror</span></label>
                                <select id="priority" name="priority" class="mt-2 block w-full rounded-md border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="">Select</option>
                                    <option value="1" {{ (old('priority') == '1') ? 'selected' : '' }}>Low</option>
                                    <option value="2" {{ (old('priority') == '2') ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ (old('priority') == '3') ? 'selected' : '' }}>High</option>
                                    <option value="4" {{ (old('priority') == '4') ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <div class="flex justify-between">
                            <div class="text-sm text-red-500">* Required</div>
                            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
