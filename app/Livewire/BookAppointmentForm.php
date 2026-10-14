<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\BookAppointmentAction;
use App\Models\Branch;
use Livewire\Component;

class BookAppointmentForm extends Component
{
    public $branch_id = '';

    public $customer_name = '';

    public $customer_phone = '';

    public $appointment_time = '';

    public $successMessage = '';

    public $assignedQueueNumber = null;

    protected function rules(): array
    {
        return [
            'branch_id' => 'required|exists:branches,id',
            'customer_name' => 'required|string|min:3|max:100',
            'customer_phone' => 'required|string|min:10|max:15',
            'appointment_time' => 'required|date|after:now',
        ];
    }

    /**
     * SENIOR UPGRADE: The Real-Time Validation Hook
     * This runs automatically every time any form property changes in the browser.
     */
    public function updated($propertyName)
    {
        // Validates only the specific field that was just modified
        $this->validateOnly($propertyName);
    }

    public function submitForm(BookAppointmentAction $action)
    {
        $validatedData = $this->validate();
        $appointment = $action->execute($validatedData);

        $this->assignedQueueNumber = $appointment->queue->queue_number;
        $this->successMessage = 'Appointment secured successfully!';

        $this->reset(['branch_id', 'customer_name', 'customer_phone', 'appointment_time']);
    }

    public function render()
    {
        return view('livewire.book-appointment-form', [
            'branches' => Branch::all(),
        ]);
    }
}
