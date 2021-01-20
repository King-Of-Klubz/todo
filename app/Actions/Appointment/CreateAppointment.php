<?php
namespace App\Actions\Appointment;

use App\Contracts\Appointment\CreatesAppointment;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class CreateAppointment implements CreatesAppointment
{

    public function create(array $input)
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'dateTime'],
            'endDate' => ['required', 'dateTime'],
        ])->validateWithBag('createAppointment');

        $appointment = new Appointment();

        return $appointment->create([
            'title' => $input['title'],
            'startDate' => $input['startDate'],
            'endDate'=> $input['endDate']
        ]);
    }
}
