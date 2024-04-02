<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Number;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;


    public function shifts() {
        return $this->hasMany(Shift::class);
    }

    protected function paddedId(): Attribute {
        return new Attribute(
            get: fn() => str_pad($this->id, 5, '0', STR_PAD_LEFT),
        );
    }

    protected function amount(): Attribute {
        return new Attribute(
            get: fn() => Number::currency($this->shifts()->sum('total')),
        );
    }

    protected function status(): Attribute {
        return Attribute::make(
            get: fn($status) => $status === 1 ? 'Paid' : 'Not Paid',
        );
    }
}
