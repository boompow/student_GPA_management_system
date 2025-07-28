<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


// models
use App\Models\Course;
use App\Models\Semester;
use App\Models\Enrollment;

class Student extends Model
{
    public function course(): HasManyThrough{
        return $this->hasManyThrough(Course::class, Enrollment::class);
    }

    public function semester(): HasManyThrough{
        return $this->hasManyThrough(Semester::class, Enrollment::class);
    }

    public function enrollment(): HasMany{
        return $this->hasMany(Enrollment::class);
    }
}
