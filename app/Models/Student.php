<?php

namespace App\Models;

use App\Http\Controllers\DivisionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function standerd(){
        return $this->belongsTo(Standerd::class,'standname','id');
    }

    
    public function division(){
        return $this->belongsTo(division::class,'subname','id');
    }
}
