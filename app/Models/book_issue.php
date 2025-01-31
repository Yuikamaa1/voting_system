<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class book_issue extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the student that owns the book_issue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $table='book_issues';
    protected $fillable=['student_adm_no','book_name','book_number','issue_date','return_date'];


    protected $casts = [
        'issue_date' => 'datetime:Y-m-d',
        'return_date' => 'datetime:Y-m-d',
    ];

}
