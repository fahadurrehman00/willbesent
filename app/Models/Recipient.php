<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'user_id',
        'type',
        'state',
        'zip',
        'city',
        'street'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
