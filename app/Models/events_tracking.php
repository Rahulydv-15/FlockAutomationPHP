<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events_tracking extends Model
{
    protected $table = 'events_tracking';
    use HasFactory;
    // protected $filable=[
    //     'id',
    //     'reference_id',
    //     'application_id'
    // ];
}
