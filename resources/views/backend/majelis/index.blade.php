@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Majelis Jemaat</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="card mb-3">
            <div class="card-header d-grid gap-2 d-lg-flex justify-content-lg-end">
                <a href="/dashboard/majelis/create" type="button" class="btn btn-success"><i
                        class="fa-solid fa-circle-plus"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive col-lg-8 mb-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-primary">
                                <th style="width: 2cm">No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($majelis as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td><a href="/dashboard/majelis/{{ $item->id }}/edit" class="badge bg-warning"
                                            style="text-decoration: none"> <i class="fa-solid fa-pen"></i> Edit</a>
                                        <form action="/dashboard/majelis/{{ $item->id }}" method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Apakah anda yakin?')" title="Hapus">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
