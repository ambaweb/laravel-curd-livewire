<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'country',
        'state',
        'phone',
        'gender',
        'dob'
    ];

    protected $casts = [
        'dob' => 'date:Y-m-d'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => preg_replace("/[^0-9]/",'', $value),
        );
    }

    protected function dob(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m/d/Y'),
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
