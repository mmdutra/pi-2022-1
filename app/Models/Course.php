<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name', 'description'];
    public $timestamps = false;

    public function teachers()
    {
        return $this->belongsToMany(
            related: Teacher::class,
            table:'teacher_courses'
        );
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
