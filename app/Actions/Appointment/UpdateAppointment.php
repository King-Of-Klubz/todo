<?php


namespace App\Actions\Appointment;


use App\Contracts\Appointment\UpdatesAppointment;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class UpdateAppointment implements UpdatesAppointment
{

    public function update($appointment, array $input)
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'dateTime'],
            'endDate' => ['required', 'dateTime'],
        ])->validateWithBag('updateAppointment');

        $appointment = new Appointment();

        return $appointment->update([
            'title' => $input['title'],
            'startDate' => $input['startDate'],
            'endDate'=> $input['endDate']
        ]);
    }
}
