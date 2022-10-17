<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authors extends Model
{
    use HasFactory;



    public function author_books()
    {
        return $this->hasMany(Books::class);
    }

}
