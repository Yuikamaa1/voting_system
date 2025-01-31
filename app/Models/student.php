<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable=['name','class','admission_no','admission_date','gender','parent_phone'];

}
