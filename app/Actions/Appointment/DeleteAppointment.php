<?php


namespace App\Actions\Appointment;


use App\Contracts\Appointment\DeletesAppointment;

class DeleteAppointment implements DeletesAppointment
{

    public function delete($appointment)
    {
        $appointment->delete();
    }
}
