<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Standerd extends Model
{
    use HasFactory;
    public static function softDelete($condition)
    {
        return DB::table('users')->where($condition)->update(['isDeleted'=>1]);
    }
}
