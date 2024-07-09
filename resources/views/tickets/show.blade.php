<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <main class="py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
            <div class="flex items-center space-x-5">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900"><span class="font-medium text-gray-500">Subject:</span> {{ $ticket->subject }}</h1>
                </div>
            </div>
            @if($ticket->status != 'closed')
                <form action="{{ route('ticket.close', $ticket->id) }}" method="post">
                    @csrf
                    <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Close Ticket</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="mx-auto mt-8 grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2 lg:col-start-1">
                <section aria-labelledby="applicant-information-title">
                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Ticket Information</h2>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Submitted by</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->user->email }}</dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Message</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $ticket->body }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section aria-labelledby="notes-title">
                    <div class="bg-white shadow sm:overflow-hidden sm:rounded-lg">
                        <div class="divide-y divide-gray-200">
                            <div class="px-4 py-5 sm:px-6">
                                <h2 id="notes-title" class="text-lg font-medium text-gray-900">Messages</h2>
                            </div>
                            <div class="px-4 py-6 sm:px-6">
                                <ul role="list" class="space-y-8">
                                    @foreach($ticket->replies as $reply)
                                        <li>
                                            <div class="flex space-x-3">
                                                <div>
                                                    <div class="text-sm text-gray-500">
                                                        From: <span class="text-base font-medium text-gray-700">{{ $reply->user->first_name }} {{ $reply->user->last_name }}</span>
                                                    </div>
                                                    <div class="mt-1 text-sm text-gray-700">
                                                        {{ $reply->body }}
                                                    </div>
                                                    <div class="text-sm font-medium text-gray-500 mt-4">
                                                        {{ $reply->created_at->format('F j') }} at {{ $reply->created_at->format('g:i A') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($ticket->status != 'closed')
                            <div class="bg-gray-50 px-4 py-6 sm:px-6">
                                <div class="flex space-x-3">
                                    <div class="min-w-0 flex-1">
                                        <livewire:create-reply :ticketId="$ticket->id" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
            <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3">
                <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                    <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Ticket Details</h2>
                    <div class="mt-3">
                        <div class="flex justify-between gap-x-2 py-1">
                            <h3 class="text-sm text-gray-500">Ticket Number</h3>
                            <div class="text-sm text-gray-700">{{ $ticket->id }}</div>
                        </div>
                        <div class="flex justify-between gap-x-2 py-1">
                            <h3 class="text-sm text-gray-500">Date</h3>
                            <div class="text-sm text-gray-700">{{ $ticket->created_at->format('d/m/Y H:i:s') }}</div>
                        </div>
                        <div class="flex justify-between gap-x-2 py-1">
                            <h3 class="text-sm text-gray-500">Priority</h3>
                            <div class="text-sm text-gray-700"><x-priority-badge :number="$ticket->priority" /></div>
                        </div>
                        <div class="flex justify-between gap-x-2 py-1">
                            <h3 class="text-sm text-gray-500">Category</h3>
                            <div class="text-sm text-gray-700">{{ $ticket->category->name }}</div>
                        </div>
                        <div class="flex justify-between gap-x-2 py-1">
                            <h3 class="text-sm text-gray-500">Status</h3>
                            <div class="text-sm text-gray-700">{{ ucfirst($ticket->status) }}</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
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
                                <p class="text-sm font-medium text-gray-900">Successfully added</p>
                                <p class="mt-1 text-sm text-gray-500">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(session('closed'))
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
                                <p class="text-sm font-medium text-gray-900">Successfully Closed</p>
                                <p class="mt-1 text-sm text-gray-500">{{ session('closed') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

{{--    @can('view', $ticket)--}}
{{--        <p>YES</p>--}}
{{--    @else--}}
{{--        <p>NO</p>--}}
{{--    @endcan--}}


</x-app-layout>
