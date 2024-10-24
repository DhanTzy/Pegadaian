@extends('admin.layouts.app')

@section('title', 'Edit Nasabah')

@section('contents')
    <h1 class="fw-bold fs-3 text-center">Edit Data Nasabah</h1>
    <div class="pb-4">
        <div class="mt-4">
            <form action="{{ route('admin.nasabah.update', $nasabah->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Identitas yang Dipakai</label>
                    <div>
                        <input type="radio" name="identitas" value="KTP"{{ $nasabah->identitas == 'KTP' ? 'checked' : '' }}> KTP
                        <input type="radio" name="identitas" value="SIM"{{ $nasabah->identitas == 'SIM' ? 'checked' : '' }}> SIM
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Identitas (KTP/SIM)</label>
                    <input id="nomor_identitas" name="nomor_identitas" type="text" value="{{ $nasabah->nomor_identitas }}" class="form-control">
                </div>

                <div class="mb3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ $nasabah->nama_lengkap }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ $nasabah->tempat_lahir }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ $nasabah->tanggal_lahir }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Perkawinan</label>
                    <select name="status_perkawinan" class="form-select">
                        <option value="Belum Menikah" {{ $nasabah->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ $nasabah->status_perkawinan == 'Menikah' ? 'selected' : '' }}>Menikah
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" placeholder="Alamat Lengkap" rows="3" class="form-control">{{ $nasabah->alamat_lengkap }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Pos</label>
                    <input id="kode_pos" name="kode_pos" type="text" value="{{ $nasabah->kode_pos }}"class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Pekerjaan</label>
                    <input id="pekerjaan" name="pekerjaan" type="text" value="{{ $nasabah->pekerjaan }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input id="email" name="email" type="email" value="{{ $nasabah->email }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" value="{{ $nasabah->telepon }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Orang Tua (Ayah/Ibu)</label>
                    <input id="nama_orang_tua" name="nama_orang_tua" type="text" value="{{ $nasabah->nama_orang_tua }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto KTP/SIM</label>
                    <input type="file" name="foto_ktp_sim" class="form-control" accept="image/*" id="foto_ktp_sim_input"
                        onchange="previewFoto()">
                    @if ($nasabah->foto_ktp_sim)
                        <!-- Gambar lama yang akan diubah saat pilih foto baru -->
                        <img id="foto_ktp_sim_preview" src="{{ asset('storage/' . $nasabah->foto_ktp_sim) }}"
                            alt="Foto KTP/SIM Lama" class="img-fluid mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="editConfirmModal" tabindex="-1" aria-labelledby="editConfirmModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editConfirmModalLabel">Konfirmasi Perubahan Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda Yakin Ingin Mengubah Data Ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="confirmEditSubmit">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
                    data-bs-target="#editConfirmModal">Perbarui Data</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary w-20">Kembali</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('confirmEditSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        function previewFoto() {
            const input = document.getElementById('foto_ktp_sim_input');
            const preview = document.getElementById('foto_ktp_sim_preview');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Ganti src dari gambar lama dengan preview dari file baru
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file, kembalikan preview ke gambar lama atau sembunyikan
                preview.src = "{{ asset('storage/' . $nasabah->foto_ktp_sim) }}";
            }
        }
    </script>
@endsection
