<?php

namespace App\Models;

use App\Http\Resources\AppointmentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    protected $fillable = [
        'id',
        'title',
        'startDate',
        'endDate'
    ];
    public function toResource()
    {
        return new AppointmentResource($this);
    }
}
