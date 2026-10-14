<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Clinic Appointment Planner</h2>

    <!-- Show Success Alert Box if booking completes -->
    @if ($successMessage)
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md text-center">
            <p class="text-green-800 font-semibold">{{ $successMessage }}</p>
            <p class="text-sm text-gray-600 mt-1">Your Live Ticket Token is:</p>
            <span class="inline-block bg-green-600 text-white font-mono text-2xl px-4 py-1 rounded-full mt-2 tracking-wider">
                #{{ $assignedQueueNumber }}
            </span>
        </div>
    @endif

    <!-- Form Element targeting the PHP submitForm method -->
    <form wire:submit.prevent="submitForm" class="space-y-4">
        
    <!-- 1. Clinic Dropdown Selection -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Select Clinic Location</label>
        <select wire:model.blur="branch_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">-- Choose a Branch --</option>
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->name }} ({{ $branch->location }})</option>
            @endforeach
        </select>
        @error('branch_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    <!-- 2. Full Name Input -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" wire:model.blur="customer_name" placeholder="John Doe" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('customer_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    <!-- 3. Phone Number Input -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
        <input type="text" wire:model.blur="customer_phone" placeholder="0123456789" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('customer_phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    <!-- 4. Date & Time Input -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Preferred Date & Time</label>
        <input type="datetime-local" wire:model.blur="appointment_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('appointment_time') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow transition duration-150 ease-in-out">
            Confirm & Secure Token
        </button>
    </form>
</div>
