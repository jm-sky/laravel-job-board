<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    /**
     *
     */
    public static function searchFilter($search)
    {
        return function($listing) use($search) {
            if (Str::contains(strtolower($listing->title), $search)) return true;
            if (Str::contains(strtolower($listing->company), $search)) return true;
            if (Str::contains(strtolower($listing->location), $search)) return true;
            // if (Str::contains(strtolower($listing->content), $search)) return true;

            return false;
        };
    }

}
