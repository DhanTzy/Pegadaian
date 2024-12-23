@extends('admin.layouts.app')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Daftar Pajak</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary float-left mb-2" id="btnTambahPajak"
                                data-bs-toggle="modal" data-bs-target="#modalForm">
                                Tambah Pajak
                            </button>

                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <table id="myTable" class="table table-striped table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Bunga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pajaks as $pajak)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pajak->bulan }}</td>
                                            <td>{{ $pajak->bunga }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm me-2 btnEditPajak"
                                                    data-id="{{ $pajak->id }}" data-bulan="{{ $pajak->bulan }}"
                                                    data-bunga="{{ $pajak->bunga }}" data-bs-toggle="modal"
                                                    data-bs-target="#modalForm">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.transaksi.pajak.destroy', $pajak->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm me-2"
                                                        onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="formPajak" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalFormLabel">Tambah/Edit Pajak</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="bulan" class="form-label">Bulan</label>
                                                <input type="text" class="form-control" id="bulan" name="bulan"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="bunga" class="form-label">Bunga</label>
                                                <input type="text" class="form-control" id="bunga" name="bunga"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const formPajak = document.getElementById("formPajak");
            const modalLabel = document.getElementById("modalFormLabel");
            const bulanInput = document.getElementById("bulan");
            const bungaInput = document.getElementById("bunga");

            // Handle Tambah Pajak
            document.getElementById("btnTambahPajak").addEventListener("click", function() {
                formPajak.action = "{{ route('admin.transaksi.pajak.store') }}";
                formPajak.method = "POST";
                formPajak.querySelector('input[name="_method"]')?.remove(); // Hapus method PUT jika ada
                bulanInput.value = "";
                bungaInput.value = "";
                modalLabel.textContent = "Tambah Pajak";
            });

            // Handle Edit Pajak
            document.querySelectorAll(".btnEditPajak").forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const bulan = this.getAttribute("data-bulan");
                    const bunga = this.getAttribute("data-bunga");

                    formPajak.action = `/admin/transaksi/pajak/${id}`;
                    formPajak.method = "POST";

                    // Tambahkan input hidden untuk method PUT
                    let methodInput = formPajak.querySelector('input[name="_method"]');
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = "hidden";
                        methodInput.name = "_method";
                        methodInput.value = "PUT";
                        formPajak.appendChild(methodInput);
                    }

                    bulanInput.value = bulan;
                    bungaInput.value = bunga;
                    modalLabel.textContent = "Edit Pajak";
                });
            });
        });
    </script>
@endsection
