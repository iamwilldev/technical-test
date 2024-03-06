<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Jenssegers\Agent\Agent;
use Spatie\Activitylog\Models\Activity;
use Stevebauman\Location\Facades\Location;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes, HasRoles, LogsActivity;

    public const AVATAR_PATH = 'avatars';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'initial_name',
        'avatar_url'
    ];

    protected function getInitialNameAttribute(): string
    {
        $name = strtoupper(trim($this->name));
        $initials = '';

        foreach (explode(' ', $name) as $word) {
            $initials .= $word[0];
        }

        return $initials;
    }

    protected function getAvatarUrlAttribute(): string
    {
        $defaultAvatar = asset('images/profile/user-1.jpg');

        return $this->avatar
            ? asset('storage/' . self::AVATAR_PATH . '/' . $this->avatar) : $defaultAvatar;
    }

    public function getActivitylogOptions(): LogOptions
    {
        $agent = new Agent();
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "User successfully {$eventName} by " . Auth::user()->name . " using " . $agent->browser() . " on " . $agent->platform() . " from " . request()->ip());
    }

    public function tapActivity(Activity $activity)
    {
        // $location = Location::get('103.169.170.178');
        $location = Location::get(request()->ip());
        $locationInfo = $location ? $location->countryName . ', ' . $location->regionName . ', ' . $location->cityName . ', ' . $location->zipCode : 'Unknown';

        $activity->properties = $activity->properties->merge([
            'agent' => [
                'ip' => request()->ip(),
                'devices' => (new Agent())->device(),
                'platform' => (new Agent())->platform(),
                'browser' => (new Agent())->browser(),
                'location' => $locationInfo,
            ],
        ]);
    }
}
