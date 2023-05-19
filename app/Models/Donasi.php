<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Donasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'donasis';

}
