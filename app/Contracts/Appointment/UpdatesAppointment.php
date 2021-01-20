<?php


namespace App\Contracts\Appointment;


interface UpdatesAppointment
{
    public function update($appointment, array $input);
}
