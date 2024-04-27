<?php

namespace App\Models;
use App\Models\Department;
use App\Models\Project;
use App\Models\Note;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, softDelets;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'position',
    ];
    public function department()
{
    return $this->belongsTo(Department::class);
}


public function projects()
{
    return $this->belongsToMany(Project::class);
}
public function notes():MorphMany{
    return $this->morphMany(Note::class,noteable );
}

}
