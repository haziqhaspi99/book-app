<!-- Senior Tip: wire:poll.3s tells Livewire to auto-refresh this data block every 3 seconds -->
<div wire:poll.3s class="max-w-5xl mx-auto my-10 p-6 bg-slate-900 text-black rounded-2xl shadow-2xl">
    
    
    <div class="flex justify-between items-center border-b border-slate-700 pb-6 mb-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-indigo-400">LIVE WAITING ROOM MONITOR</h1>
        <select wire:model.live="branchId" class="bg-slate-800 text-black rounded-lg border-slate-700 font-semibold px-4 py-2 text-sm focus:ring-indigo-500">
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Left Section: Huge Active Ticket Display -->
        <div class="lg:col-span-2 bg-slate-800 border border-slate-700 rounded-xl p-10 flex flex-col justify-center items-center text-center shadow-inner">
            <h2 class="text-lg font-bold text-slate-400 uppercase tracking-widest">NOW SERVING</h2>
            
            @if($currentlyServing)
                <div class="animate-bounce my-8">
                    <span class="text-8xl md:text-9xl font-mono font-black text-emerald-400 tracking-wider">
                        #{{ $currentlyServing->queue_number }}
                    </span>
                </div>
                <p class="text-xl font-medium text-slate-300">Please proceed to Counter 1</p>
            @else
                <div class="my-12">
                    <span class="text-5xl font-bold text-slate-500 tracking-wide">WAITING...</span>
                </div>
                <p class="text-sm text-slate-400">Counter staff will call the next number shortly.</p>
            @endif
        </div>

        <!-- Right Side: Upcoming Token Registry -->
        <div class="bg-slate-800 border border-slate-700 rounded-xl p-6">
            <h2 class="text-sm font-bold text-indigo-400 uppercase tracking-wider mb-4 border-b border-slate-700 pb-2">
                Next in Line
            </h2>
            
            <div class="space-y-3">
                @forelse($upcomingQueues as $next)
                    <div class="bg-slate-700/50 p-4 rounded-lg flex justify-between items-center border border-slate-600/40">
                        <span class="font-mono text-2xl font-bold text-slate-200">#{{ $next->queue_number }}</span>
                        <span class="text-xs uppercase font-semibold px-2.5 py-1 bg-amber-500/20 text-amber-400 rounded-full tracking-wider animate-pulse">
                            Waiting
                        </span>
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-500 text-sm">
                        No upcoming tickets.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

     <audio id="chimePlayer" preload="auto">
        <source src="{{ asset('audio/bell.wav') }}" type="audio/wav">
    </audio>

    <script>
        document.addEventListener('livewire:init', () => {
            const player = document.getElementById('chimePlayer');

            // Listen for the 'play-chime' event dispatched by our Livewire backend
            Livewire.on('play-chime', () => {
                if (player) {
                    player.currentTime = 0; // Rewind audio to the start
                    player.play().catch(error => {
                        console.log("Browser block bypass hint: Click anywhere on the display screen page once to unlock audio autoplay rules.");
                    });
                }
            });
        });
    </script>
</div>
</div>
