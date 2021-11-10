<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketing extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_number','ticket_description','price','car_number'
    ];
}
