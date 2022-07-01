<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *
     */
    public function clicks()
    {
        return $this->hasMany(Click::class);
    }

    /**
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public function tags()
    {
        // return $this->hasMany(Tag::class);
        return $this->belongsToMany(Tag::class);
    }

    /**
     *
     */
    public function scopeActive($query)
    {
        return $query->whereIsActive(true);
    }

}
