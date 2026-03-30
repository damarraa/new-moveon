<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profiling;
use App\Models\CheckinManifestPenumpang;

class CheckinManifest extends Model
{
    use HasFactory;

    protected $table = 'checkin_manifests';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'profiling_id',
        'jenis_layanan',
        'asal',
        'tujuan',
        'tanggal_berangkat',
        'jam_berangkat',
        'telepon',
        'bawa_kendaraan',
        'jenis_kendaraan',
        'plat_nomor',
        'jumlah_penumpang',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_berangkat' => 'date',
            'jumlah_penumpang' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($checkin) {
            if (empty($checkin->id)) {
                $checkin->id = (string) Str::uuid();
            }

            if (empty($checkin->user_id) && !empty($checkin->profiling_id)) {
                $profiling = Profiling::find($checkin->profiling_id);

                if ($profiling) {
                    $checkin->user_id = $profiling->user_id;
                }
            }

            if (empty($checkin->status)) {
                $checkin->status = 'draft';
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function profiling()
    {
        return $this->belongsTo(Profiling::class, 'profiling_id', 'id');
    }

    public function penumpangs()
    {
        return $this->hasMany(CheckinManifestPenumpang::class, 'checkin_manifest_id', 'id');
    }
}