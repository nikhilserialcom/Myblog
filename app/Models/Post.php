<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'posts';
    // protected $primaryKey = 'id';

    protected $fillable = [
        'authorId',
        'title',
        'post_slug',
        'body',
        'categoryname',
        'postImage',
    ];

    public function sluggable(): array
    {
        return [
            'post_slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class,'authorId');
    }
}
