<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Jenssegers\Agent\Agent;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Stevebauman\Location\Facades\Location;

class Driver extends Model
{
    protected $tables = 'drivers';

    use HasFactory, HasUuids, SoftDeletes, HasRoles, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'address',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $agent = new Agent();
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "Driver successfully {$eventName} by " . Auth::user()->name . " using " . $agent->browser() . " on " . $agent->platform() . " from " . request()->ip());
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
