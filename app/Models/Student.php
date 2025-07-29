<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


// models
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\Course;

class Student extends Model
{
    public function semester(): BelongsToMany{
        return $this->BelongsToMany(Semester::class, 'enrollments')
        ->withPivot(['semester_id', 'score', 'grade', 'grade_point'])
        ->withTimestamps()
        ->distinct();
    }

    public function course(): BelongsToMany{
        return $this->BelongsToMany(Course::class, 'enrollments')
        ->withPivot(['course_id', 'score', 'grade', 'grade_point'])
        ->withTimestamps()
        ->distinct();
    }

    public function enrollment(): HasMany{
        return $this->hasMany(Enrollment::class);
    }

     // calculate the cumulative GPA
    public function cumulative_GPA(): void{
        $total_credit_hour = 0;
        $total_grade_point = 0;

        foreach ($this->enrollment as $enrollement) {
            $course = Course::find($enrollement->course_id);
            if(!$course){
                continue;
            }

            $credit = $course->credit_hour;
            $grade_point = $enrollement->grade_point;

            $total_credit_hour += $credit;
            $total_grade_point += $grade_point * $credit;
        }

        $this->cumulative_gpa = $total_credit_hour > 0 ? round($total_grade_point / $total_credit_hour, 2) : 0.0;

        $this->save();
    }
}
