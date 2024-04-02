<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'finish_time' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'invoice_id',
        'site_id',
        'date',
        'start_time',
        'finish_time',
        'rate',
        'total',
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function site() {
        return $this->belongsTo(Site::class)->withTrashed();
    }
}
