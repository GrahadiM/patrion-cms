<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Character extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'full_name',
        'region',
        'philosophy',
        'height',
        'weight',
        'artifact',
        'power',
        'island',
        'origin',
        'dna',
        'attitude',
        'character',
        'colors',
        'color_names',
        'image',
        'thumbnail',
        'video',
        'description',
        'status',
        'order',
    ];

    protected $casts = [
        'colors' => 'array',
        'color_names' => 'array',
        'status' => 'string',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'status', 'region'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Character {$this->name} {$eventName}")
            ->useLogName('characters');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($character) {
            if (empty($character->slug)) {
                $character->slug = Str::slug($character->name);
            }
        });

        static::updating(function ($character) {
            if ($character->isDirty('name') && empty($character->slug)) {
                $character->slug = Str::slug($character->name);
            }
        });
    }
}
