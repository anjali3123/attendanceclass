<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    use HasFactory;
    protected $table = 'standerd_divisions';
    public function standerd(){
        return $this->belongsTo(Standerd::class,'std_id','id');
    }
    public function div(){
        return $this->belongsTo(Division::class,'div_id','id');
    }
    
}
