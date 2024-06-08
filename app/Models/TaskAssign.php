<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssign extends Model
{
    use HasFactory;
    protected $fillable = ['assign_to', 'assign_by', 'task_id'];

}
