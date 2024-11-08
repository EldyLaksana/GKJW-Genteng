@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kabar Jemaat</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/kabar-jemaat/create" type="button" class="btn btn-success"><i
                        class="fa-solid fa-circle-plus"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="col-lg-3 mb-2">
                    <form action="{{ route('kabar-jemaat.index') }}" method="GET" class="input-group">
                        <input type="text" name="judul" class="form-control" value="{{ request('judul') }}"
                            placeholder="Cari Judul Kabar Jemaat">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                <div class="table-responsive col-lg-12 mb-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-primary">
                                <th style="width: 2cm">No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Published at</th>
                                <th style="width: 6cm">Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kabarJemaat as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($kabarJemaat->currentPage() - 1) * $kabarJemaat->perPage() }}
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->status_publikasi }}</td>
                                    <td>{{ $item->published_at }}</td>
                                    <td>
                                        <a href="/dashboard/kabar-jemaat/{{ $item->slug }}" class="badge bg-success"
                                            style="text-decoration: none"> <i class="fa-solid fa-eye"></i> Show</a>
                                        @if (Auth::id() === $item->user_id || auth()->user()->isAdmin === 1)
                                            <a href="/dashboard/kabar-jemaat/{{ $item->slug }}/edit"
                                                class="badge bg-warning" style="text-decoration: none"> <i
                                                    class="fa-solid fa-pen"></i> Edit</a>
                                        @endif
                                        @if (auth()->user()->isAdmin == 1)
                                            <form action="/dashboard/kabar-jemaat/{{ $item->slug }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0"
                                                    onclick="return confirm('Apakah anda yakin?')" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $kabarJemaat->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
