<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use Illuminate\Support\Carbon;

class DailyLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'log',
        'day'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFromToday($query)
    {
        return $query->whereDate('day', today());
    }

    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value),

        )->withoutObjectCaching();
    }
}
