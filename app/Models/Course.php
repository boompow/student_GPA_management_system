<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Enrollment;

use App\Models\Semester;
use App\Models\Student;

class Course extends Model
{
     public function student(): BelongsToMany{
        return $this->BelongsToMany(Student::class, 'enrollments')
        ->withPivot(['course_id', 'score', 'grade', 'grade_point'])
        ->withTimestamps()
        ->distinct();
    }

     public function semester(): BelongsToMany{
        return $this->BelongsToMany(Semester::class, 'enrollments')
        ->withPivot(['course_id', 'score', 'grade', 'grade_point'])
        ->withTimestamps()
        ->distinct();
    }
    
    public function enrollment(): HasMany{
        return $this->hasMany(Enrollment::class);
    }
}
