<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
   use HasFactory;

    protected $fillable = [
        'user_id',
        'url',
        'title',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_website');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function website_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
