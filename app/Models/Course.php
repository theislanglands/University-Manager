<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function noOfCourses($department)
    {
        // $noOfCorses = $this->where::($department_id = $department);
        //return 'lowest price';
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

}
