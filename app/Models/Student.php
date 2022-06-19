<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['user_id', 'status', 'average'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(
            related: Course::class,
            table:'student_courses'
        );
    }

    public function activities()
    {
        return $this->belongsToMany(
            related: Activity::class,
            table:'student_activities'
        );
    }
}
