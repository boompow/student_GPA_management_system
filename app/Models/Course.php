<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Enrollment;

class Course extends Model
{
    public function enrollment(): HasMany{
        return $this->hasMany(Enrollment::class);
    }
}
