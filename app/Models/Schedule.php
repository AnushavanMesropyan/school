<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable=['start','end','teacher_id','class_room_id'];
    use HasFactory;
    /**
     * Get the user that owns the teacher.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id','id');
    }
    /**
     * Get the user that owns the Class Room.
     */
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class,'class_room_id','id');
    }
}
