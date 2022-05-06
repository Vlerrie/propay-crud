<?php

namespace App\Models\People;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = [
        'id'
    ];

    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'person_interests');
    }

    public function implodedInterests()
    {
        return implode(',', $this->interests->pluck('description')->toArray());
    }
}
