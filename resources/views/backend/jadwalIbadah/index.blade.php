@extends('backend.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Jadwal Ibadah</h1>
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
                <a href="/jadwal-ibadah/create" type="button" class="btn btn-success"><i
                        class="fa-solid fa-circle-plus"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive col-lg-10 mb-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="table-primary">
                                <th style="width: 2cm">No</th>
                                <th>Kegiatan</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Tempat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalIbadah as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ $item->jam }}</td>
                                    <td>{{ $item->tempat }}</td>
                                    <td><a href="jadwal-ibadah/{{ $item->id }}/edit" class="badge bg-warning"
                                            style="text-decoration: none"> <i class="fa-solid fa-pen"></i> Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
