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

    protected $table = 'programs';
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'title',
    //     'slug',
    //     'description',
    //     'synopsis',
    //     'thumbnail',
    //     'image',
    //     'trailer',
    //     'platform',
    //     'status',
    //     'release_date',
    //     'duration',
    //     'rating',
    //     'director',
    //     'budget',
    //     'episodes',
    //     'views',
    //     'characters',
    //     'platforms',
    //     'production',
    //     'gallery',
    //     'order',
    // ];

    protected $casts = [
        'characters' => 'array',
        'platforms' => 'array',
        'production' => 'array',
        'gallery' => 'array',
        'status' => 'string',
        'platform' => 'string',
        'episodes' => 'integer',
        'views' => 'integer',
        'order' => 'integer',
    ];

    // Platform constants
    const PLATFORM_CINEMA = 'cinema';
    const PLATFORM_TV = 'tv';
    const PLATFORM_STREAMING = 'streaming';
    const PLATFORM_YOUTUBE = 'youtube';
    const PLATFORM_GAME = 'game';
    const PLATFORM_OTT = 'ott';
    const PLATFORM_DIGITAL = 'digital';
    const PLATFORM_PODCAST = 'podcast';

    // Status constants
    const STATUS_DRAFT = 'draft';
    const STATUS_UPCOMING = 'upcoming';
    const STATUS_ONGOING = 'ongoing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PRODUCTION = 'production';
    const STATUS_RELEASED = 'released';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'status', 'platform'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Program {$this->title} {$eventName}")
            ->useLogName('programs');
    }

    // Helper method untuk mendapatkan karakter berdasarkan slug
    public function getCharactersData()
    {
        if (!$this->characters || !is_array($this->characters)) {
            return collect();
        }

        return Character::whereIn('slug', $this->characters)->get();
    }

    // Platform accessor untuk tampilan yang lebih baik
    public function getPlatformLabelAttribute()
    {
        return match($this->platform) {
            self::PLATFORM_CINEMA => 'Cinema',
            self::PLATFORM_TV => 'TV',
            self::PLATFORM_STREAMING => 'Streaming',
            self::PLATFORM_YOUTUBE => 'YouTube',
            self::PLATFORM_GAME => 'Game',
            self::PLATFORM_OTT => 'OTT',
            self::PLATFORM_DIGITAL => 'Digital',
            self::PLATFORM_PODCAST => 'Podcast',
            default => ucfirst($this->platform),
        };
    }

    // Status accessor untuk tampilan yang lebih baik
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_UPCOMING => 'Upcoming',
            self::STATUS_ONGOING => 'Ongoing',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_PRODUCTION => 'Production',
            self::STATUS_RELEASED => 'Released',
            default => ucfirst($this->status),
        };
    }

    // Status color untuk badge
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'yellow',
            self::STATUS_UPCOMING => 'blue',
            self::STATUS_ONGOING => 'green',
            self::STATUS_COMPLETED => 'gray',
            self::STATUS_PRODUCTION => 'purple',
            self::STATUS_RELEASED => 'green',
            default => 'gray',
        };
    }

    // Platform color untuk badge
    public function getPlatformColorAttribute()
    {
        return match($this->platform) {
            self::PLATFORM_CINEMA => 'purple',
            self::PLATFORM_TV => 'red',
            self::PLATFORM_STREAMING => 'blue',
            self::PLATFORM_YOUTUBE => 'red',
            self::PLATFORM_GAME => 'green',
            self::PLATFORM_OTT => 'indigo',
            self::PLATFORM_DIGITAL => 'teal',
            self::PLATFORM_PODCAST => 'orange',
            default => 'gray',
        };
    }

    // Platform icon untuk tampilan
    public function getPlatformIconAttribute()
    {
        return match($this->platform) {
            self::PLATFORM_CINEMA => 'fas fa-film',
            self::PLATFORM_TV => 'fas fa-tv',
            self::PLATFORM_STREAMING => 'fas fa-play-circle',
            self::PLATFORM_YOUTUBE => 'fab fa-youtube',
            self::PLATFORM_GAME => 'fas fa-gamepad',
            self::PLATFORM_OTT => 'fas fa-tv',
            self::PLATFORM_DIGITAL => 'fas fa-globe',
            self::PLATFORM_PODCAST => 'fas fa-podcast',
            default => 'fas fa-globe',
        };
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', self::STATUS_UPCOMING);
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', self::STATUS_ONGOING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeReleased($query)
    {
        return $query->where('status', self::STATUS_RELEASED);
    }

    public function scopeProduction($query)
    {
        return $query->where('status', self::STATUS_PRODUCTION);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function getCharactersAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setCharactersAttribute($value)
    {
        $this->attributes['characters'] = json_encode($value ?? []);
    }

    public function getPlatformsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setPlatformsAttribute($value)
    {
        $this->attributes['platforms'] = json_encode($value ?? []);
    }

    public function getProductionAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setProductionAttribute($value)
    {
        $this->attributes['production'] = json_encode($value ?? []);
    }

    public function getGalleryAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setGalleryAttribute($value)
    {
        $this->attributes['gallery'] = json_encode($value ?? []);
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
