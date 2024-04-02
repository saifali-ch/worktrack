<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'role',
        'first_name',
        'last_name',
        'email',
        'address',
        'post_code',
        'account_name',
        'short_code',
        'account_number',
        'photo',
        'first_login',
        'active',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isWorker(): bool {
        return $this->role === 'worker';
    }

    public function scopeWorker(Builder $query): void {
        $query->whereRole('worker');
    }

    protected function name(): Attribute {
        return new Attribute(
            get: fn() => "$this->first_name $this->last_name",
        );
    }

    protected function photo(): Attribute {
        return Attribute::make(
            fn($value) => $value ? Storage::url($value) : null,
        );
    }

    protected function redactedAccountNumber(): Attribute {
        return new Attribute(
            get: fn() => Str::padLeft(substr($this->account_number, -4), strlen($this->account_number), '*')
        );
    }

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
