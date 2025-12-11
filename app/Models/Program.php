<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'synopsis',
        'thumbnail',
        'image',
        'trailer',
        'platform',
        'status',
        'release_date',
        'duration',
        'rating',
        'director',
        'budget',
        'episodes',
        'views',
        'characters',
        'platforms',
        'production',
        'gallery',
        'order',
    ];

    protected $casts = [
        'characters' => 'array',
        'platforms' => 'array',
        'production' => 'array',
        'gallery' => 'array',
        'status' => 'string',
        'platform' => 'string',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'platform'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Program {$this->title} {$eventName}")
            ->useLogName('programs');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });

        static::updating(function ($program) {
            if ($program->isDirty('title') && empty($program->slug)) {
                $program->slug = Str::slug($program->title);
            }
        });
    }
}
