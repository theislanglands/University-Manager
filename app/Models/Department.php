<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    public function course() {
        return $this->hasMany(Course::class);
    }
}
