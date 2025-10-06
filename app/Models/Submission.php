<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'contact_email',
        'contact_phone',
        'birth_date',
        'gender',
        'country',
        'files',
        'comments',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
