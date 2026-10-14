<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Queue;
use Livewire\Component;

class QueueDisplay extends Component
{
    public $branchId = 1;

    public $lastServedId = null; // Senior Practice: Cache state to detect transitions

    public function render()
    {
        $currentlyServing = Queue::where('branch_id', $this->branchId)
            ->where('status', 'serving')
            ->latest('updated_at')
            ->first();

        // If a new ticket is called, dispatch a frontend browser event
        if ($currentlyServing && $currentlyServing->id !== $this->lastServedId) {
            $this->lastServedId = $currentlyServing->id;

            // Senior Tip: Dispatches a native browser event that JavaScript can listen to
            $this->dispatch('play-chime');
        }

        return view('livewire.queue-display', [
            'branches' => Branch::all(),
            'currentlyServing' => $currentlyServing,
            'upcomingQueues' => Queue::where('branch_id', $this->branchId)
                ->where('status', 'waiting')
                ->whereDate('created_at', today())
                ->orderBy('queue_number', 'asc')
                ->take(4)
                ->get(),
        ])->layout('layouts.app');
    }
}
