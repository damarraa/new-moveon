@php
    $oldPenumpangs = old('penumpangs');

    if (!empty($oldPenumpangs)) {
        $initialPenumpangs = array_values(array_map(function ($item, $index) {
            return [
                'nik' => $item['nik'] ?? '',
                'nama' => $item['nama'] ?? '',
                'tanggal_lahir' => $item['tanggal_lahir'] ?? '',
            ];
        }, $oldPenumpangs, array_keys($oldPenumpangs)));
    } elseif (isset($manifest) && $manifest->penumpangs->count()) {
        $initialPenumpangs = $manifest->penumpangs->map(function ($p) {
            return [
                'nik' => $p->nik,
                'nama' => $p->nama,
                'tanggal_lahir' => \Carbon\Carbon::parse($p->tanggal_lahir)->format('Y-m-d'),
            ];
        })->values()->toArray();
    } else {
        $initialPenumpangs = [
            ['nik' => '', 'nama' => '', 'tanggal_lahir' => '']
        ];
    }

    $oldJenis = old('jenis_layanan', $manifest->jenis_layanan ?? 'pelayaran');
    $oldProfilingId = old('profiling_id', $manifest->profiling_id ?? '');
    $oldAsal = old('asal', $manifest->asal ?? '');
    $oldTujuan = old('tujuan', $manifest->tujuan ?? '');
    $oldTanggal = old('tanggal_berangkat', isset($manifest) ? \Carbon\Carbon::parse($manifest->tanggal_berangkat)->format('Y-m-d') : '');
    $oldJam = old('jam_berangkat', isset($manifest) ? \Carbon\Carbon::parse($manifest->jam_berangkat)->format('H:i') : '');
    $oldTelepon = old('telepon', $manifest->telepon ?? '');
    $oldBawa = old('bawa_kendaraan', $manifest->bawa_kendaraan ?? 'Tidak');
    $oldJenisKendaraan = old('jenis_kendaraan', $manifest->jenis_kendaraan ?? '');
    $oldPlat = old('plat_nomor', $manifest->plat_nomor ?? '');
    $oldStatus = old('status', $manifest->status ?? 'draft');

    $roroNames = ['KMP Lome', 'KMP Tirus Meranti', 'KMP Wira Loewisa', 'KMP Teluk Singkil'];
@endphp

<div class="app-page">
    <div class="content-card mb-3">
        <div class="card-body">
            <div class="section-head">
                <h5 class="section-title mb-1">1. Jenis Layanan & Jadwal Keberangkatan</h5>
                <p class="section-subtitle mb-0">
                    Pilih layanan, lalu cari jadwal keberangkatan. Lebih nyaman kalau penumpang langsung pilih jadwal yang sudah ada.
                </p>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Jenis Layanan</label>
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="service-card pilihan-layanan {{ $oldJenis === 'pelayaran' ? 'active' : '' }}" data-jenis="pelayaran">
                                <input type="radio"
                                       name="jenis_layanan"
                                       value="pelayaran"
                                       class="service-radio jenis-layanan-radio"
                                       {{ $oldJenis === 'pelayaran' ? 'checked' : '' }}>
                                <div class="service-card-body">
                                    <div class="service-icon">🚢</div>
                                    <div>
                                        <div class="service-title">Pelayaran Umum</div>
                                        <div class="service-subtitle">Kapal laut reguler antar pulau</div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="service-card pilihan-layanan {{ $oldJenis === 'penyeberangan' ? 'active' : '' }}" data-jenis="penyeberangan">
                                <input type="radio"
                                       name="jenis_layanan"
                                       value="penyeberangan"
                                       class="service-radio jenis-layanan-radio"
                                       {{ $oldJenis === 'penyeberangan' ? 'checked' : '' }}>
                                <div class="service-card-body">
                                    <div class="service-icon">⛴️</div>
                                    <div>
                                        <div class="service-title">Penyeberangan Roro</div>
                                        <div class="service-subtitle">Kapal penyeberangan kendaraan dan penumpang</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    @error('jenis_layanan')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Pilih Jadwal Keberangkatan</label>
                    <select name="profiling_id"
                            id="profiling_id"
                            class="form-select select-jadwal @error('profiling_id') is-invalid @enderror">
                        <option value="">-- Cari jadwal keberangkatan --</option>

                        @foreach($kapals as $kapal)
                            @php
                                $isRoro = in_array($kapal->nama_kapal, $roroNames);
                                $jenisKapal = $isRoro ? 'penyeberangan' : 'pelayaran';
                                $waktuText = $kapal->waktu_keberangkatan
                                    ? \Carbon\Carbon::parse($kapal->waktu_keberangkatan)->format('d-m-Y H:i')
                                    : '-';
                            @endphp
                            <option value="{{ $kapal->id }}"
                                    data-jenis="{{ $jenisKapal }}"
                                    data-nama="{{ $kapal->nama_kapal }}"
                                    data-asal="{{ $kapal->asal_keberangkatan }}"
                                    data-tujuan="{{ $kapal->tujuan_keberangkatan }}"
                                    data-tanggal="{{ $kapal->waktu_keberangkatan ? \Carbon\Carbon::parse($kapal->waktu_keberangkatan)->format('Y-m-d') : '' }}"
                                    data-jam="{{ $kapal->waktu_keberangkatan ? \Carbon\Carbon::parse($kapal->waktu_keberangkatan)->format('H:i') : '' }}"
                                    {{ (string)$oldProfilingId === (string)$kapal->id ? 'selected' : '' }}>
                                {{ $kapal->nama_kapal }} | {{ $kapal->asal_keberangkatan }} - {{ $kapal->tujuan_keberangkatan }} | {{ $waktuText }}
                            </option>
                        @endforeach
                    </select>
                    @error('profiling_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        Gunakan pencarian untuk cari nama kapal, rute, atau jadwal keberangkatan.
                    </small>
                </div>

                <div class="col-12 col-lg-6">
                    <label class="form-label">Asal</label>
                    <input type="text"
                           name="asal"
                           id="asal"
                           value="{{ $oldAsal }}"
                           readonly
                           class="form-control bg-light @error('asal') is-invalid @enderror">
                    @error('asal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-6">
                    <label class="form-label">Tujuan</label>
                    <input type="text"
                           name="tujuan"
                           id="tujuan"
                           value="{{ $oldTujuan }}"
                           readonly
                           class="form-control bg-light @error('tujuan') is-invalid @enderror">
                    @error('tujuan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-4">
                    <label class="form-label">Tanggal Berangkat</label>
                    <input type="date"
                           name="tanggal_berangkat"
                           id="tanggal_berangkat"
                           value="{{ $oldTanggal }}"
                           readonly
                           class="form-control bg-light @error('tanggal_berangkat') is-invalid @enderror">
                    @error('tanggal_berangkat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-4">
                    <label class="form-label">Jam Berangkat</label>
                    <input type="time"
                           name="jam_berangkat"
                           id="jam_berangkat"
                           value="{{ $oldJam }}"
                           readonly
                           class="form-control bg-light @error('jam_berangkat') is-invalid @enderror">
                    @error('jam_berangkat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-4">
                    <label class="form-label">No. WhatsApp</label>
                    <input type="text"
                           name="telepon"
                           value="{{ $oldTelepon }}"
                           class="form-control @error('telepon') is-invalid @enderror"
                           placeholder="08xxxxxxxxxx">
                    @error('telepon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-4 kendaraan-wrap {{ $oldJenis === 'penyeberangan' ? '' : 'd-none' }}">
                    <label class="form-label">Bawa Kendaraan</label>
                    <select name="bawa_kendaraan" id="bawa_kendaraan" class="form-select">
                        <option value="Tidak" {{ $oldBawa === 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        <option value="Ya" {{ $oldBawa === 'Ya' ? 'selected' : '' }}>Ya</option>
                    </select>
                </div>

                <div class="col-12 col-lg-4 kendaraan-detail-wrap {{ $oldJenis === 'penyeberangan' && $oldBawa === 'Ya' ? '' : 'd-none' }}">
                    <label class="form-label">Jenis Kendaraan</label>
                    <input type="text"
                           name="jenis_kendaraan"
                           id="jenis_kendaraan"
                           value="{{ $oldJenisKendaraan }}"
                           class="form-control @error('jenis_kendaraan') is-invalid @enderror">
                    @error('jenis_kendaraan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-4 kendaraan-detail-wrap {{ $oldJenis === 'penyeberangan' && $oldBawa === 'Ya' ? '' : 'd-none' }}">
                    <label class="form-label">Plat Nomor</label>
                    <input type="text"
                           name="plat_nomor"
                           id="plat_nomor"
                           value="{{ $oldPlat }}"
                           class="form-control @error('plat_nomor') is-invalid @enderror">
                    @error('plat_nomor')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-lg-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $oldStatus === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="proses" {{ $oldStatus === 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $oldStatus === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body">
            <div class="section-head d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h5 class="section-title mb-1">2. Daftar Penumpang</h5>
                    <p class="section-subtitle mb-0">Tambah satu atau lebih penumpang sesuai kebutuhan.</p>
                </div>
                <button type="button" class="btn btn-outline-primary" id="btnTambahPenumpang">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Penumpang
                </button>
            </div>

            @error('penumpangs')
                <small class="text-danger d-block mb-3">{{ $message }}</small>
            @enderror

            <div id="penumpangContainer">
                @foreach($initialPenumpangs as $index => $penumpang)
                    <div class="passenger-card penumpang-item">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0 fw-semibold penumpang-title">Penumpang #{{ $index + 1 }}</h6>
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger btnHapusPenumpang"
                                    {{ count($initialPenumpangs) <= 1 ? 'style=display:none;' : '' }}>
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-lg-4">
                                <label class="form-label">NIK</label>
                                <input type="text"
                                       name="penumpangs[{{ $index }}][nik]"
                                       value="{{ $penumpang['nik'] }}"
                                       class="form-control">
                            </div>

                            <div class="col-12 col-lg-4">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text"
                                       name="penumpangs[{{ $index }}][nama]"
                                       value="{{ $penumpang['nama'] }}"
                                       class="form-control">
                            </div>

                            <div class="col-12 col-lg-4">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date"
                                       name="penumpangs[{{ $index }}][tanggal_lahir]"
                                       value="{{ $penumpang['tanggal_lahir'] }}"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="page-form-actions">
                <a href="{{ route('operator.manifest.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> {{ $submitLabel ?? 'Simpan' }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .section-head {
        margin-bottom: 1rem;
        padding-bottom: .85rem;
        border-bottom: 1px solid #e9eef5;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .section-subtitle {
        font-size: 12px;
        color: #64748b;
    }

    .service-card {
        display: block;
        cursor: pointer;
    }

    .service-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .service-card-body {
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 1rem;
        background: #fff;
        display: flex;
        align-items: center;
        gap: .85rem;
        transition: .2s ease;
        cursor: pointer;
    }

    .service-card.active .service-card-body {
        border-color: var(--brand-primary);
        background: #f8fbff;
        box-shadow: 0 8px 20px rgba(15,123,217,.08);
    }

    .service-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef6ff;
        font-size: 22px;
        flex-shrink: 0;
    }

    .service-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .service-subtitle {
        font-size: 12px;
        color: #64748b;
    }

    .passenger-card {
        border: 1px solid #e9eef5;
        border-radius: 16px;
        background: #f8fbff;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .select2-container .select2-selection--single {
        height: 42px !important;
        border-radius: 10px !important;
        border: 1px solid var(--line) !important;
        display: flex !important;
        align-items: center !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
        padding-left: 12px !important;
        padding-right: 30px !important;
        font-size: 13px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }

    .select2-dropdown {
        border-radius: 10px !important;
        border: 1px solid var(--line) !important;
        overflow: hidden;
    }

    .select2-search__field {
        border-radius: 8px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function () {
        const $profiling = $('#profiling_id');
        const $asal = $('#asal');
        const $tujuan = $('#tujuan');
        const $tanggal = $('#tanggal_berangkat');
        const $jam = $('#jam_berangkat');
        const $bawaKendaraan = $('#bawa_kendaraan');

        function updateCardActive() {
            $('.pilihan-layanan').removeClass('active');
            $('.jenis-layanan-radio:checked').each(function () {
                $(this).closest('.pilihan-layanan').addClass('active');
            });
        }

        function filterJadwalByJenis() {
            const jenis = $('.jenis-layanan-radio:checked').val() || 'pelayaran';

            $profiling.find('option').each(function () {
                const value = $(this).val();
                if (!value) {
                    $(this).prop('disabled', false).show();
                    return;
                }

                const optionJenis = $(this).data('jenis');
                if (optionJenis === jenis) {
                    $(this).prop('disabled', false).show();
                } else {
                    if ($(this).is(':selected')) {
                        $(this).prop('selected', false);
                    }
                    $(this).prop('disabled', true).hide();
                }
            });

            $profiling.val('').trigger('change.select2');
            clearJadwalFields();

            if (jenis === 'penyeberangan') {
                $('.kendaraan-wrap').removeClass('d-none');
            } else {
                $('.kendaraan-wrap').addClass('d-none');
                $('.kendaraan-detail-wrap').addClass('d-none');
                $bawaKendaraan.val('Tidak');
                $('#jenis_kendaraan').val('');
                $('#plat_nomor').val('');
            }
        }

        function clearJadwalFields() {
            $asal.val('');
            $tujuan.val('');
            $tanggal.val('');
            $jam.val('');
        }

        function fillJadwalFields() {
            const $selected = $profiling.find('option:selected');
            if (!$selected.length || !$selected.val()) {
                clearJadwalFields();
                return;
            }

            $asal.val($selected.data('asal') || '');
            $tujuan.val($selected.data('tujuan') || '');
            $tanggal.val($selected.data('tanggal') || '');
            $jam.val($selected.data('jam') || '');
        }

        $profiling.select2({
            placeholder: '-- Cari jadwal keberangkatan --',
            allowClear: true,
            width: '100%'
        });

        $('.jenis-layanan-radio').on('change', function () {
            updateCardActive();
            filterJadwalByJenis();
        });

        $profiling.on('change', function () {
            fillJadwalFields();
        });

        $bawaKendaraan.on('change', function () {
            if ($(this).val() === 'Ya') {
                $('.kendaraan-detail-wrap').removeClass('d-none');
            } else {
                $('.kendaraan-detail-wrap').addClass('d-none');
                $('#jenis_kendaraan').val('');
                $('#plat_nomor').val('');
            }
        });

        $('#btnTambahPenumpang').on('click', function () {
            const index = $('#penumpangContainer .penumpang-item').length;

            const html = `
                <div class="passenger-card penumpang-item">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 fw-semibold penumpang-title">Penumpang #${index + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger btnHapusPenumpang">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-lg-4">
                            <label class="form-label">NIK</label>
                            <input type="text" name="penumpangs[${index}][nik]" class="form-control">
                        </div>

                        <div class="col-12 col-lg-4">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="penumpangs[${index}][nama]" class="form-control">
                        </div>

                        <div class="col-12 col-lg-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="penumpangs[${index}][tanggal_lahir]" class="form-control">
                        </div>
                    </div>
                </div>
            `;

            $('#penumpangContainer').append(html);
            refreshPenumpangNumbers();
        });

        $(document).on('click', '.btnHapusPenumpang', function () {
            if ($('#penumpangContainer .penumpang-item').length <= 1) {
                return;
            }

            $(this).closest('.penumpang-item').remove();
            refreshPenumpangNumbers();
        });

        function refreshPenumpangNumbers() {
            $('#penumpangContainer .penumpang-item').each(function (index) {
                $(this).find('.penumpang-title').text('Penumpang #' + (index + 1));
                $(this).find('input[name*="[nik]"]').attr('name', `penumpangs[${index}][nik]`);
                $(this).find('input[name*="[nama]"]').attr('name', `penumpangs[${index}][nama]`);
                $(this).find('input[name*="[tanggal_lahir]"]').attr('name', `penumpangs[${index}][tanggal_lahir]`);
            });

            if ($('#penumpangContainer .penumpang-item').length <= 1) {
                $('.btnHapusPenumpang').hide();
            } else {
                $('.btnHapusPenumpang').show();
            }
        }

        updateCardActive();

        if ($('.jenis-layanan-radio:checked').length) {
            const jenisAwal = $('.jenis-layanan-radio:checked').val();

            $profiling.find('option').each(function () {
                const value = $(this).val();
                if (!value) return;

                const optionJenis = $(this).data('jenis');
                if (optionJenis !== jenisAwal) {
                    $(this).prop('disabled', true).hide();
                }
            });

            $profiling.trigger('change.select2');

            if (jenisAwal === 'penyeberangan') {
                $('.kendaraan-wrap').removeClass('d-none');
            } else {
                $('.kendaraan-wrap').addClass('d-none');
            }
        }

        if ($profiling.val()) {
            fillJadwalFields();
        }

        if ($bawaKendaraan.val() === 'Ya' && $('.jenis-layanan-radio:checked').val() === 'penyeberangan') {
            $('.kendaraan-detail-wrap').removeClass('d-none');
        }

        refreshPenumpangNumbers();
    });
</script>
@endpush