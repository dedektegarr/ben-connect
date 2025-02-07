@extends('BackOffice.layout.layout1')
@section('title', 'Data User')
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
                                    <h2 class="card-title text-end">Data User BEN-CONNECT Provinsi Bengkulu</h2>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addUserModal">
                                        Tambah User
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <table id="example" class="display table table-responsive"
                                style="width:100%;background-color: transparent; display:table;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadUserData() {
            let token = localStorage.getItem("authToken"); // Ambil token dari localStorage

            if (!token) {
                alert("Anda belum login!"); // Pastikan user sudah login
                return;
            }

            $.ajax({
                url: "http://127.0.0.1:8000/api/user/data",
                type: "GET",
                dataType: "json",
                headers: {
                    "Authorization": "Bearer " + token // Kirim token di header
                },
                success: function(response) {
                    let userData = response.data_user;
                    let tableBody = $('#userTable tbody');
                    tableBody.empty();

                    $.each(userData, function(index, user) {
                        tableBody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-primary edit-btn" data-id="${user.id}">Edit</button>
                                <button class="btn btn-danger delete-btn" data-id="${user.id}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                `);
                    });

                    $('#userTable').DataTable();
                },
                error: function(xhr) {
                    alert("Gagal mengambil data, pastikan token valid!");
                }
            });
        }
        loadUserData()
    </script>


@endsection
