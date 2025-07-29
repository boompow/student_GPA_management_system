<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Student;
use App\Models\Semester;
use App\Models\Course;

class Enrollment extends Model
{
    public function course(): BelongsTo{
        return $this->belongsTo(Course::class);
    }
    public function semester(): BelongsTo{
        return $this->belongsTo(Semester::class);
    }
    public function student(): BelongsTo{
        return $this->belongsTo(Student::class);
    }

    // calculating and adding the GPA and the grade before saving
    protected static function booted(){
        static::saving(function($enrollment){
            if(!is_null($enrollment->score)){
                if($enrollment->score >= 90){
                    $enrollment->grade_point = 4.0;
                    $enrollment->grade = 'A+';
                }

                elseif($enrollment->score >= 85){
                    $enrollment->grade_point = 4.0;
                    $enrollment->grade = 'A';
                }

                elseif($enrollment->score >= 80){
                    $enrollment->grade_point = 3.7;
                    $enrollment->grade = 'A-';
                }

                elseif($enrollment->score >= 75){
                    $enrollment->grade_point = 3.3;
                    $enrollment->grade = 'B+';
                }

                elseif($enrollment->score >= 70){
                    $enrollment->grade_point = 3.0;
                    $enrollment->grade = 'B';
                }

                elseif($enrollment->score >= 65){
                    $enrollment->grade_point = 2.7;
                    $enrollment->grade = 'B-';
                }

                elseif($enrollment->score >= 60){
                    $enrollment->grade_point = 2.3;
                    $enrollment->grade = 'C+';
                }

                elseif($enrollment->score >= 50){
                    $enrollment->grade_point = 2.0;
                    $enrollment->grade = 'C';
                }

                else{
                    $enrollment->grade_point = 0.0;
                    $enrollment->grade = 'F';
                };
            }
        });


        //updating the GPA with change in enrollment
        static::saved(function ($enrollment) {
            $enrollment->semester->semester_GPA();
            $enrollment->student->cumulative_GPA();
        });

        static::deleted(function ($enrollment) {
            $enrollment->semester->semester_GPA();
            $enrollment->student->cumulative_GPA();
        });
    }
}
