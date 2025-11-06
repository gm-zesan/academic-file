<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['term_id','batch_id','course_type_id','teacher_id','name','code','description'];

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function type()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
