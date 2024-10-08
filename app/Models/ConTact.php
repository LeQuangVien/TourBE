<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConTact extends Model
{
    use HasFactory;
    protected $table = 'con_tacts';
    protected $fillable = [
        'ho_va_ten',
        'email',
        'subject',
        'message',
    ];
}
