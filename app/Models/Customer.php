<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function quotes()
    {
        return $this->hasMany(Quotation::class, 'customer_id', 'id');
    }
    public function teams()
    {
        return $this->hasMany(Team::class, 'customer_id', 'id');
    }
    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'customer_id', 'id');
    }



}
