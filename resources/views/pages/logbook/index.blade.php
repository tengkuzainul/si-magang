@extends('layouts.app', ['title' => 'Log Book' . $magang->siswa->name])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Log Book</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Log Books</div>
                <div class="breadcrumb-item">{{ $magang->siswa->name }}</div>
            </div>
        </div>

        <div class="section-body">
            @if ($magang->tahunAjaran->status_logbook == 'Tutup')
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <p class="text-dark font-weigth-medium h5">
                        <i class="fas fa-info-circle mr-2 h3"></i> &mdash; Pengisian Logbook untuk Tahun Ajaran
                        {{ $magang->tahunAjaran->tahun_magang }} Sudah Ditutup!
                    </p>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Log Book {{ $magang->siswa->name }} | Tahun Ajaran
                    {{ $magang->tahunAjaran->tahun_magang }}</h2>
                @hasanyrole('super-admin|siswa')
                    <button type="button"
                        class="btn btn-primary px-3 btn-rounded {{ $magang->tahunAjaran->status_logbook == 'Tutup' ? 'disabled' : '' }}"
                        id="addLogbookBtn">
                        <i class="fas fa-plus-circle mr-2"></i>Buat Logbook
                    </button>
                @endhasanyrole
            </div>

            @hasanyrole('super-admin|siswa')
                <div class="row align-items-center d-none" id="logbookFormCard">
                    <div class="col-xl-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="text-dark">Form Buat Logbook</h4>
                            </div>
                            <form action="{{ route('logbook.store', $magang->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark font-weight-medium" for="deskripsi">Deskripsi
                                                    Kegiatan</label>
                                                <div class="input-group">
                                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="4"
                                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                                        placeholder="Berikan penjelasan mengenai kegiatan di tempat magang anda pada hari ini! (Max: 100 kata)" autofocus>{{ old('deskripsi') }}</textarea>

                                                    @error('deskripsi')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark font-weight-medium" for="lampiran_foto">Lampirkan Foto
                                                    kegiatan (Image: JPEG,JPG,PNG)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-image"></i>
                                                        </span>
                                                    </div>
                                                    <input type="file" name="lampiran_foto" id="lampiran_foto"
                                                        value="{{ old('lampiran_foto') }}"
                                                        class="form-control @error('lampiran_foto') is-invalid @enderror"
                                                        placeholder="lampiran_foto" aria-label="lampiran_foto">
                                                    @error('lampiran_foto')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="reset" class="btn btn-danger btn-rounded px-3">
                                            <i class="fas fa-undo mr-2"></i>Reset Form
                                        </button>
                                        <button type="submit" class="btn btn-success btn-rounded px-3">
                                            <i class="fas fa-check-circle mr-2"></i>Reset Form
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endhasanyrole

            <div class="row">

                @forelse($magang->logbooks as $logbook)
                    <div class="col-12 col-md-4 col-lg-4">
                        <article class="article article-style-c">
                            <div class="article-header">
                                <div class="article-image"
                                    data-background="{{ asset('lampiran-foto-logbook/' . $logbook->lampiran_foto) }}">
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-category">
                                    <a href="{{ route('magang.tambahLogbook', $magang->id) }}"
                                        class="disabled">{{ date('d F Y', strtotime($logbook->created_at)) }}</a>
                                    <div class="bullet"></div> <a href="{{ route('magang.tambahLogbook', $magang->id) }}"
                                        class="disabled">{{ $logbook->created_at->diffForHumans() }}</a>
                                </div>
                                <p class="my-3 deskripsi" style="word-break: break-word;">
                                    {{ $logbook->deskripsi }}
                                </p>
                                <a href="javascript:void(0);" class="readMore text-primary"><span class="mr-2">Lihat
                                        Selengkapnya</span><i class="fas fa-arrow-right"></i></a>
                                <div class="article-user">
                                    <img alt="image"
                                        src="{{ $magang->siswa->image ? asset('image-profile/' . $magang->siswa->image) : 'https://ui-avatars.com/api/?name=' . $magang->siswa->name . '&background=000&color=f5f5f5&rounded=true' }}">
                                    <div class="article-user-details">
                                        <div class="user-detail-name">
                                            <a
                                                href="{{ route('magang.tambahLogbook', $magang->id) }}">{{ $magang->siswa->name }}</a>
                                        </div>
                                        <div class="text-job">{{ $magang->tempat_magang }}</div>
                                        <div class="my-2">
                                            @if ($logbook->status == 'Disetujui')
                                                <span class="badge badge-success px-2 w-100">
                                                    <i class="fas fa-check-circle mr-2"></i>Disetujui
                                                </span>
                                            @else
                                                <span class="badge badge-warning px-2 text-dark w-100">
                                                    <i class="fas fa-clock mr-2 text-dark"></i>Menunggu Persetujuan
                                                </span>
                                            @endif
                                        </div>
                                        @hasanyrole('super-admin|guru-pembimbing')
                                            <div class="my-2">
                                                @if ($logbook->status != 'Disetujui')
                                                    <a href="{{ route('logbook.ubahStatus', $logbook->id) }}"
                                                        class="btn btn-success rounded-pill w-100 mt-2"
                                                        onclick="event.preventDefault(); document.getElementById('setujui-logbook-{{ $logbook->id }}').submit();">
                                                        <i class="fas fa-check-square mr-2"></i> Setujui Logbook
                                                    </a>

                                                    <form id="setujui-logbook-{{ $logbook->id }}"
                                                        action="{{ route('logbook.ubahStatus', $logbook->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                @else
                                                    <a href="{{ route('logbook.ubahStatus', $logbook->id) }}"
                                                        class="btn btn-danger rounded-pill w-100 mt-2"
                                                        onclick="event.preventDefault(); document.getElementById('setujui-logbook-{{ $logbook->id }}').submit();">
                                                        <i class="fas fa-times-circle mr-2"></i> Batal Setujui
                                                    </a>

                                                    <form id="setujui-logbook-{{ $logbook->id }}"
                                                        action="{{ route('logbook.ubahStatus', $logbook->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                @endif
                                            </div>
                                        @endhasanyrole
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Log Book {{ $magang->tahunAjaran->tahun_magang }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="empty-state" data-height="400">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <h2>Kosong</h2>
                                    <p class="lead">
                                        Silahkan membuat Logbook magang dengan menekan tombol <span
                                            class="text-danger">Buat
                                            Logbook</span> di kanan atas!.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('dynamic-form-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addLogbookBtn = document.getElementById('addLogbookBtn');
            const logbookFormCard = document.getElementById('logbookFormCard');

            addLogbookBtn.addEventListener('click', function() {
                logbookFormCard.classList.toggle('d-none');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deskripsiElements = document.querySelectorAll('.deskripsi');
            const readMoreBtns = document.querySelectorAll('.readMore');
            const maxLength = 100;

            deskripsiElements.forEach(function(deskripsiElement, index) {
                const fullText = deskripsiElement.innerText;

                if (fullText.length > maxLength) {
                    const truncatedText = fullText.substring(0, maxLength) + '...';
                    deskripsiElement.innerText = truncatedText;

                    readMoreBtns[index].style.display = 'inline';
                } else {
                    readMoreBtns[index].style.display = 'none';
                }

                readMoreBtns[index].addEventListener('click', function() {
                    deskripsiElement.innerText = fullText;
                    readMoreBtns[index].style.display = 'none';
                });
            });
        });
    </script>
@endpush
