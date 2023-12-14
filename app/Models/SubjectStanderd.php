<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectStanderd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'subject_standerds';

    public function subject() {
        return $this->belongsTo(Subject::class,'sub_id','id');
    }
}
