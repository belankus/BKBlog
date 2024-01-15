<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\AssignOp\Concat;

class Post extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    public function getRouteKeyName(): string
    {
        return 'slug';
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

    public function getName($post)
    {
        $firstname = Str::of($post->user->name)->split('/[\s,]+/')->get(0);
        $secondname = Str::of($post->user->name)->split('/[\s,]+/')->get(1);
        $name = $firstname . ' ' . $secondname;
        return $name;
    }
}
