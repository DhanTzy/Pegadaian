@extends('layouts.app')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Daftar Pekerjaan</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="card mb-4">
                        <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                            <p class="fw-bold" id="current-info" style="margin: 0; font-size: 16px; color:red"></p>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary float-left mb-2" id="btnTambahPekerjaan"
                                data-bs-toggle="modal" data-bs-target="#modalForm">
                                Tambah Pekerjaan
                            </button>

                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if ($errors->has('posisi_pekerjaan'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('posisi_pekerjaan') }}
                                </div>
                            @endif

                            <table id="myTable" class="table table-striped table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Posisi Pekerjaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pekerjaans as $pekerjaan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pekerjaan->posisi_pekerjaan }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm me-2 btnEditPekerjaan"
                                                    data-id="{{ $pekerjaan->id }}"
                                                    data-posisi="{{ $pekerjaan->posisi_pekerjaan }}" data-bs-toggle="modal"
                                                    data-bs-target="#modalForm">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('karyawan.pekerjaan.destroy', $pekerjaan->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm me-2"
                                                        onclick="return confirm('Yakin ingin menghapus?')"><i
                                                            class="fas fa-trash-alt"></i></button>
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
                                    <form id="formPekerjaan" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalFormLabel">Tambah/Edit Pekerjaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->has('posisi_pekerjaan'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('posisi_pekerjaan') }}
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="posisi_pekerjaan" class="form-label">Posisi Pekerjaan</label>
                                                <input type="text" class="form-control" id="posisi_pekerjaan"
                                                    name="posisi_pekerjaan" required>
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
        function updateTime() {
            const now = new Date();
            const dayString = now.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            const dateString = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const fullString = `${dayString}, ${dateString}, ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();

        document.addEventListener("DOMContentLoaded", function() {
            const formPekerjaan = document.getElementById("formPekerjaan");
            const modalLabel = document.getElementById("modalFormLabel");
            const posisiInput = document.getElementById("posisi_pekerjaan");

            document.getElementById("btnTambahPekerjaan").addEventListener("click", function() {
                formPekerjaan.action = "{{ route('karyawan.pekerjaan.store') }}";
                formPekerjaan.method = "POST";
                posisiInput.value = "";
                modalLabel.textContent = "Tambah Pekerjaan";

                const methodInput = formPekerjaan.querySelector("input[name='_method']");
                if (methodInput) {
                    methodInput.remove();
                }
            });

            document.querySelectorAll(".btnEditPekerjaan").forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const posisi = this.getAttribute("data-posisi");

                    formPekerjaan.action = `/admin/karyawan/pekerjaan/${id}`;
                    formPekerjaan.method = "POST";

                    if (!formPekerjaan.querySelector("input[name='_method']")) {
                        const methodInput = document.createElement("input");
                        methodInput.type = "hidden";
                        methodInput.name = "_method";
                        methodInput.value = "PUT";
                        formPekerjaan.appendChild(methodInput);
                    }

                    posisiInput.value = posisi;
                    modalLabel.textContent = "Edit Pekerjaan";
                });
            });
        });
    </script>
@endsection
