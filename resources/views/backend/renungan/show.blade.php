@extends('backend.layouts.main')

@section('container')
    <section class="section">
        <div class="card my-4">
            <div class="card-body">
                <div class="col-lg-8">
                    <h2 class="mb-3">{{ $renungan->judul }}</h2>


                    <a href="/dashboard/renungan" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    <a href="/dashboard/renungan/{{ $renungan->slug }}/edit" class="btn btn-warning" style="color: white"><i
                            class="fa-solid fa-pen"></i>
                        Edit</a>
                    <form action="#" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i
                                class="fa-solid fa-trash"></i> Hapus</button>
                    </form>

                    <img src="{{ asset('storage/' . $renungan->gambar) }}" alt="" class="img-fluid my-3">

                    @if ($renungan->sumber_gambar)
                        <p style="font-style: italic; font-size: 14px">Sumber : <a href="{{ $renungan->sumber_gambar }}"
                                target="_blank">
                                {{ $renungan->sumber_gambar }}</a></p>
                    @endif

                    <p>{!! $renungan->renungan !!}</p>

                    @if ($renungan->sumber)
                        <p style="font-style: italic; font-size: 14px">Sumber : {{ $renungan->sumber }}</p>
                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection
