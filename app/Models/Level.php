<?php

namespace App\Models;

use App\Http\Resources\LevelResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    protected $fillable = [
        'id',
       'title',
        'color'
    ];
    public function toResource(){
        return new LevelResource($this);
    }
}
