<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id','course_type_id','name','term_id','allowed_upload'];

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }


    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }
    

}
