<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $fillable = ['title', 'body', 'due_date', 'available'];
    public $timestamps = true;
}
