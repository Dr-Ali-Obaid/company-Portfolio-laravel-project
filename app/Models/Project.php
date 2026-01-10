<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'image',
        'slug',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getRouteKeyName()
{
    return 'slug'; // هنا نخبر لارافل أن يبحث في قاعدة البيانات عن الـ slug
}
}
