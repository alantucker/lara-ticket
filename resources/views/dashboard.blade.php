<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h2 class="text-xl font-semibold leading-6 text-gray-900">My Open Tickets</h2>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <a href="{{ route('ticket.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">New Ticket</a>
                            </div>
                        </div>
                        <div class="-mx-4 mt-8 sm:-mx-0">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Date<span class="visible lg:invisible"> / Priority</span>
                                    </th>
                                    <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Priority</th>
                                    <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Subject</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">
                                        {{ $ticket->created_at->format("d/m/Y") }}
                                        <dl class="font-normal lg:hidden">
                                            <dt class="sr-only">Priority</dt>
                                            <dd class="mt-1 truncate text-gray-700">
                                                <x-priority-badge :number="$ticket->priority" />
                                            </dd>
                                            <dt class="sr-only sm:hidden">Subject</dt>
                                            <dd class="mt-1 truncate text-gray-500 sm:hidden">{{ $ticket->subject }}</dd>
                                        </dl>
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">
                                        <x-priority-badge :number="$ticket->priority" />
                                    </td>
                                    <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $ticket->subject }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $ticket->category->name }}</td>
                                    <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <a href="{{ route('ticket.show', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, Lindsay Walton</span></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-6">
                                {{ $tickets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('status'))
        <div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
                <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">Alert</p>
                                <p class="mt-1 text-sm text-gray-500">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
