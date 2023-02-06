<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function programs()
    {
        return $this->belongsTo(Program::class, 'detil_transaksis')->withPivot('qty', 'pricesum');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
