<?php

namespace App\AppJobTasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppJob extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'title'];
}
