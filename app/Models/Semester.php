<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class Semester extends Model
{
    public function student()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
            ->withPivot(['student_id', 'score', 'grade', 'grade_point'])
            ->withTimestamps()
              ->distinct();
    }
        
    public function course()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot(['course_id', 'score', 'grade', 'grade_point'])
            ->withTimestamps()
              ->distinct();
    }

    public function enrollment(): HasMany{
        return $this->hasMany(Enrollment::class);
    }

    // calculate the semester GPA
    public function semester_GPA(): void{
        $total_credit_hour = 0;
        $total_grade_point = 0;

        foreach ($this->enrollment as $enrollement) {
            dump($enrollement);
            dump("id $enrollement->course_id");
            $course = Course::find($enrollement->course_id);
            if(!$course){
                continue;
            }

            $credit = $course->credit_hour;
            $grade_point = $enrollement->grade_point;

            $total_credit_hour += $credit;
            $total_grade_point += $grade_point * $credit;

            dump("credit $credit");
            dump("grade point $grade_point");
            dump("total credit $total_credit_hour");
            dump("total grade $total_grade_point");
            dump(round($total_grade_point / $total_credit_hour, 2));
        }

        $this->semester_gpa = $total_credit_hour > 0 ? round($total_grade_point / $total_credit_hour, 2) : 0.0;

        $this->save();
    }
        
}
