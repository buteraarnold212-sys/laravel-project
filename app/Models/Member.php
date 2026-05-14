<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'address', 'phone'];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
