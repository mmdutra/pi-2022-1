<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['name', 'ra', 'user_id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
