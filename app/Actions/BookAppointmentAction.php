<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Appointment;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;

class BookAppointmentAction
{
    /**
     * Executes the appointment booking business logic safely.
     */
    public function execute(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {

            // 1. Create the persistent appointment record
            $appointment = Appointment::create([
                'branch_id' => $data['branch_id'],
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'appointment_time' => $data['appointment_time'],
            ]);

            // 2. Calculate the next queue number for this specific branch today
            // Senior Tip: max() finds the highest number issued today. If none, it starts at 1000.
            $latestQueue = Queue::where('branch_id', $data['branch_id'])
                ->whereDate('created_at', today())
                ->max('queue_number') ?? 1000;

            $nextQueueNumber = $latestQueue + 1;

            // 3. Issue the live queue token linked directly to this appointment
            Queue::create([
                'branch_id' => $data['branch_id'],
                'appointment_id' => $appointment->id,
                'queue_number' => $nextQueueNumber,
                'status' => 'waiting',
            ]);

            return $appointment;
        });
    }
}
