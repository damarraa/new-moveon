<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\CheckinManifest;

class CheckinManifestPenumpang extends Model
{
    use HasFactory;

    protected $table = 'checkin_manifest_penumpangs';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'checkin_manifest_id',
        'nik',
        'nama',
        'tanggal_lahir',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($penumpang) {
            if (empty($penumpang->id)) {
                $penumpang->id = (string) Str::uuid();
            }
        });
    }

    public function checkinManifest()
    {
        return $this->belongsTo(CheckinManifest::class, 'checkin_manifest_id', 'id');
    }
}