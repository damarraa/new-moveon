<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;

class Profiling extends Model
{
    use HasFactory;

    protected $table = 'profilings';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'nama_kapal',
        'asal_keberangkatan',
        'tujuan_keberangkatan',
        'waktu_keberangkatan',
        'kapasitas_penumpang',
    ];

    protected function casts(): array
    {
        return [
            'waktu_keberangkatan' => 'datetime',
            'kapasitas_penumpang' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($profiling) {
            if (empty($profiling->id)) {
                $profiling->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}