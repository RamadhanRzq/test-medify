@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="form-group mb-2">
                <a href="{{ url('categories') }}"
                   class="btn btn-secondary">
                    Kembali ke Daftar Kategori
                </a>
            </div>

            <div class="card">

                <div class="card-header">
                    Detail Kategori
                </div>

                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th width="150">Kode</th>
                            <td>:</td>
                            <td>{{ $data->kode }}</td>
                        </tr>

                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-4">
                        Master Items
                    </h5>

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga Beli</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($data->masterItems as $item)

                            <tr>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->harga_beli }}</td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada item pada kategori ini.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                    <a class="btn btn-info"
                       href="{{ url('categories/form/edit') }}/{{ $data->id }}">
                        Edit
                    </a>

                    <a class="btn btn-danger"
                       href="{{ url('categories/delete') }}/{{ $data->id }}"
                       onclick="return confirm('Are you sure you want to delete this category?');">
                        Delete
                    </a>

                    <a class="btn btn-success"
                       href="{{ url('categories/' . $data->kode . '/pdf') }}">
                        Download PDF
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection