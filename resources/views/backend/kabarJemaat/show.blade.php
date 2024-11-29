@extends('backend.layouts.main')

@section('container')
    <section class="section">
        <div class="card my-4">
            <div class="card-body">
                <div class="col-lg-8">
                    <h2 class="mb-3">{{ $kabarJemaat->judul }}</h2>


                    <a href="/dashboard/kabar-jemaat" class="btn btn-success"><i class="fa-solid fa-arrow-left"></i>
                        Kembali</a>
                    @if (Auth::id() === $kabarJemaat->user_id || auth()->user()->isAdmin === 1)
                        <a href="/dashboard/kabar-jemaat/{{ $kabarJemaat->slug }}/edit" class="btn btn-warning"
                            style="color: white"><i class="fa-solid fa-pen"></i>
                            Edit</a>
                    @endif
                    @if (auth()->user()->isAdmin == 1)
                        <form action="#" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i
                                    class="fa-solid fa-trash"></i> Hapus</button>
                        </form>
                    @endif

                    <img src="{{ asset('storage/' . $kabarJemaat->gambar) }}" alt="" class="img-fluid my-3">

                    @if ($kabarJemaat->sumber_gambar)
                        <p style="font-style: italic; font-size: 14px">Sumber :
                            {{ $kabarJemaat->sumber_gambar }}</p>
                    @endif

                    <p>{!! $kabarJemaat->isi !!}</p>

                    @if ($kabarJemaat->embed)
                        <div class="ratio ratio-16x9">
                            {!! $kabarJemaat->embed !!}
                        </div>
                    @endif

                    @if ($kabarJemaat->sumber)
                        <p style="font-style: italic; font-size: 14px">Sumber : {{ $kabarJemaat->sumber }}</p>
                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection
