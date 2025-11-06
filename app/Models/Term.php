<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name','start_date','end_date','status', 'is_publish_categories'];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
