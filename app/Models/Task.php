<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    protected $fillable = [
        'id',
        'description',
        'user_id'
    ];
    public function toResource()
    {
        return new \App\Http\Resources\TaskResource($this);
    }
}
