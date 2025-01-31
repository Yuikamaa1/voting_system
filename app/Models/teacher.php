<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    use HasFactory;
    protected $fillable=['teacher_name','tsc_no','gender','position','status'];
    protected $table='teachers';
}
