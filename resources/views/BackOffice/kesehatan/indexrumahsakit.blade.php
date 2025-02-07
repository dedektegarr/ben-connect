@extends('BackOffice.layout.layout1')
@section('title', 'Index Rumah Sakit')
@section('main')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h2 class="card-title text-end">Data Index Rumah Sakit BEN-CONNECT Provinsi Bengkulu</h2>
                                </div>
                            </div>
                            <hr>
                            <table id="example" class="display table table-responsive"
                                style="width:100%;background-color: transparent; display:table;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pasien Lama</th>
                                        <th>Pasien Baru</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Dummy</td>
                                        <td>Dummy</td>
                                        <td>Dummy</td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-primary" type="button">Edit</button>
                                                <button class="btn btn-danger" type="button">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
