<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceDetail extends Model
{
    protected $guarded = [];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class, 'maintenance_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
