<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
         $query->when($filters['search'] ?? false, function($query, $search) {
             return $query->where('judul', 'like', '%'.$search.'%');
         });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'donasi')->withPivot('jml_donasi', 'doa');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function program_images()
    {
        return $this->hasMany(ProgramImage::class);
    }

    public function pencairan_danas()
    {
        return $this->hasMany(PencairanDana::class);
    }
}
