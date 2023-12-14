<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;


    public function standerd(){
        return $this->belongsTo(Standerd::class,'standerdid','id');
    }


    public static function softDelete($condition)
    {
        return DB::table('subjects')->where($condition)->update(['isDeleted'=>1]);
    }
}
