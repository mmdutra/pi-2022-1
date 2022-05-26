<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = ['name', 'ra', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
