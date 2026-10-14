<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Queue;
use Livewire\Component;

class StaffDashboard extends Component
{
    public $selectedBranchId = 1; // Default to Branch 1 on load

    /**
     * Call the next waiting patient into the consulting room.
     */
    public function callNext()
    {
        // 1. Automatically change any currently 'serving' ticket to 'done'
        Queue::where('branch_id', $this->selectedBranchId)
            ->where('status', 'serving')
            ->update(['status' => 'done']);

        // 2. Fetch the earliest person waiting in line for this branch today
        $nextInLine = Queue::where('branch_id', $this->selectedBranchId)
            ->where('status', 'waiting')
            ->whereDate('created_at', today())
            ->orderBy('id', 'asc')
            ->first();

        // 3. Switch their status to 'serving' so they appear on the TV monitors
        if ($nextInLine) {
            $nextInLine->update(['status' => 'serving']);
            session()->flash('message', "Now calling Ticket #{$nextInLine->queue_number}!");
        } else {
            session()->flash('message', 'No patients remaining in the waiting queue.');
        }
    }

    /**
     * Skip a patient if they are not present when called.
     */
    public function skipTicket(int $queueId)
    {
        Queue::where('id', $queueId)->update(['status' => 'skipped']);
    }

    /**
     * Mark a currently serving appointment as successfully completed.
     */
    public function completeTicket(int $queueId)
    {
        Queue::where('id', $queueId)->update(['status' => 'done']);
    }

    public function render()
    {
        // Fetch tickets broken down into logical semantic lists for clean layout execution
        return view('livewire.staff-dashboard', [
            'branches' => Branch::all(),
            'currentServing' => Queue::where('branch_id', $this->selectedBranchId)
                ->where('status', 'serving')
                ->with('appointment')
                ->first(),
            'waitingList' => Queue::where('branch_id', $this->selectedBranchId)
                ->where('status', 'waiting')
                ->whereDate('created_at', today())
                ->with('appointment')
                ->orderBy('queue_number', 'asc')
                ->get(),
        ])->layout('layouts.app');
    }
}
