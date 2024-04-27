<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

public function employees()
{
    return $this->belongsToMany(Employee::class);
}
public function notes():MorphMany{
    return $this->morphMany(Note::class,noteable );
}

}
