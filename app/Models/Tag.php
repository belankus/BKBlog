<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) {
            DB::transaction(function () use ($tag) {
                // Find posts without any other tags after the deletion of the tag
                $postsWithoutTags = DB::table('post_tag')
                    ->select('post_id')
                    ->where('tag_id', $tag->id)
                    ->groupBy('post_id')
                    ->havingRaw('COUNT(tag_id) = 1')
                    ->pluck('post_id');

                // Insert new rows for the default tag
                $defaultTagId = 1; // Assuming the default tag has an ID of 1
                $insertData = [];
                foreach ($postsWithoutTags as $postId) {
                    $insertData[] = [
                        'post_id' => $postId,
                        'tag_id' => $defaultTagId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                DB::table('post_tag')->insert($insertData);
            });
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function tagScheme(): BelongsTo
    {
        return $this->belongsTo(TagScheme::class);
    }
}
