<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabarTerbaru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function programs()
    {
        return $this->belongsTo(Program::class);
    }

    public function program_images()
    {
        return $this->hasMany(ProgramImage::class);
    }
}
