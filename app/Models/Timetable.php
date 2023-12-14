<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{
    use HasFactory;
    protected $table = 'timetables';
    public $timestamps = false;
    public function standerd(){
        return $this->belongsTo(Standerd::class,'std_id','id');
    }
    public function subject() {
        return $this->belongsTo(Subject::class,'sub_id','id');
    }
    public function user() {
        return $this->belongsTo(User::class,'teacher_id','id');
    }
    public function day() {
        return $this->belongsTo(Day::class,'day_id','id');
    }
    public static function softDelete($condition)
    {
        return DB::table('subjects')->where($condition)->update(['isDeleted'=>1]);
    }
}
