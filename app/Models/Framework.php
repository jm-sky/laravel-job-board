<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    use HasFactory;

    public function language()
    {
        $this->belongsTo(ProgrammingLanguage::class);
    }
}
