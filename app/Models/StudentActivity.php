<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentActivity extends Model
{
    protected $table = 'student_activities';
    protected $fillable = ['late', 'file', 'student_id', 'activity_id'];
    public $timestamps = true;
}
