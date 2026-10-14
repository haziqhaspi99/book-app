<div class="max-w-4xl mx-auto bg-gray-50 p-6 rounded-xl shadow-lg mt-10">
    <!-- Header Block & Branch Selector Switch -->
    <div class="flex flex-col md:flex-row justify-between items-center border-b pb-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Clinic Staff Management Deck</h2>
        <div class="mt-2 md:mt-0">
            <label class="text-sm font-medium text-gray-600 mr-2">Managing Station:</label>
            <select wire:model.live="selectedBranchId" class="rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-indigo-100 text-indigo-800 rounded-md text-center font-medium text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Column 1: Active Action Call Counter -->
        <div class="bg-white p-5 rounded-lg shadow-sm border border-indigo-100 flex flex-col justify-between items-center text-center">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Currently Serving</h3>
                @if($currentServing)
                    <span class="block text-5xl font-mono font-black text-indigo-600 my-4">#{{ $currentServing->queue_number }}</span>
                    <p class="text-sm font-medium text-gray-700">{{ $currentServing->appointment->customer_name ?? 'Walk-In Customer' }}</p>
                @else
                    <span class="block text-3xl font-sans font-bold text-gray-300 my-6">IDLE</span>
                @endif
            </div>
            
            <div class="w-full space-y-2 mt-4">
                <button wire:click="callNext" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2.5 px-4 rounded shadow transition">
                    🔔 Call Next Ticket
                </button>
                @if($currentServing)
                    <button wire:click="completeTicket({{ $currentServing->id }})" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold py-2 rounded transition">
                        ✓ Mark as Completed
                    </button>
                @endif
            </div>
        </div>

        <!-- Column 2 & 3: Live Upcoming Queue Registry -->
        <div class="md:col-span-2 bg-white p-5 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-amber-400 mr-2 animate-pulse"></span>
                Waiting Line ({{ $waitingList->count() }} Patients)
            </h3>
            
            <div class="divide-y max-h-64 overflow-y-auto pr-2">
                @forelse($waitingList as $ticket)
                    <div class="py-3 flex justify-between items-center text-sm">
                        <div class="flex items-center space-x-3">
                            <span class="font-mono font-bold text-gray-600 bg-gray-100 px-2.5 py-1 rounded">#{{ $ticket->queue_number }}</span>
                            <div>
                                <p class="font-medium text-gray-800">{{ $ticket->appointment->customer_name ?? 'Walk-In' }}</p>
                                <p class="text-xs text-gray-400">{{ $ticket->appointment ? date('H:i A', strtotime($ticket->appointment->appointment_time)) : 'No Booking' }}</p>
                            </div>
                        </div>
                        <button wire:click="skipTicket({{ $ticket->id }})" class="text-xs text-red-500 hover:text-red-700 border border-red-200 px-2 py-1 rounded hover:bg-red-50">
                            Skip Patient
                        </button>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm text-center py-8">The waiting room is currently empty.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
