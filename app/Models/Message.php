<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'from_id',
        'to_id',
        'type',
        'is_seen',
        'body',
    ];

    // public $casts = [
    //     'is_seen' => 'boolean',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    // Other

    public function markAsSeen()
    {
        $this->update(['is_seen' => true]);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('voice')
            ->singleFile();
    }
}