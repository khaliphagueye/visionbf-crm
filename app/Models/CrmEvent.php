<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmEvent extends Model
{
    protected $fillable = [
        'user_id',
        'lead_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'type',
        'color',
        'all_day',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'all_day' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}