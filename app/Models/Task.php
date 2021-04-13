<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'priority'];

    public function project() 
    {
        return $this->belongsTo(\App\Models\Project::class);
    }
}
