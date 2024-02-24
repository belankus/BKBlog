<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getYear($published)
    {
        $published = Carbon::parse($published);
        $year = $published->format('Y');

        return $year;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getName($post)
    {
        $firstname = Str::of($post->user->name)->split('/[\s,]+/')->get(0);
        $secondname = Str::of($post->user->name)->split('/[\s,]+/')->get(1);
        $name = $firstname . ' ' . $secondname;
        return $name;
    }

    private function getEstimateReadingTime($content, $wpm = 200)
    {

        $wordCount = str_word_count(strip_tags($content));

        $minutes = (int) floor($wordCount / $wpm);
        $seconds = (int) floor($wordCount % $wpm / ($wpm / 60));

        if ($minutes === 0) {
            return $seconds . " " . Str::of('second')->plural($seconds);
        } else {
            return $minutes . " " . Str::of('minute')->plural($minutes);
        }
    }

    protected function timeToRead(): Attribute
    {

        return Attribute::make(
            get: function ($value, $attributes) {

                $value = $this->getEstimateReadingTime($attributes['content']);

                return $value;
            }
        );
    }
}
