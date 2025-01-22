{{-- @extends('layouts.app')

@section('title', 'Home Nasabah List')

@section('contents')

    <div class="content">
        <h1 class="fw-bold fs-3 text-center">Edit Data Nasabah</h1>
        <div class="pb-4">
            <div class="mt-4">
                <form action="{{ route('admin.nasabah.update', $nasabah->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ $nasabah->nama_lengkap }}" class="form-control"
                            required>
                        @error('nama_lengkap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input id="nomor_identitas" name="nomor_identitas" type="text"
                            value="{{ $nasabah->nomor_identitas }}" class="form-control" required>
                        @error('nomor_identitas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" placeholder="Alamat Lengkap" required rows="3" class="form-control">{{ $nasabah->alamat_lengkap }}</textarea>
                        @error('alamat_lengkap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelurahan</label>
                        <input id="kelurahan" name="kelurahan" type="text"
                            value="{{ $nasabah->kelurahan }}"class="form-control" required>
                        @error('kelurahan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kecamatan</label>
                        <input id="kecamatan" name="kecamatan" type="text" value="{{ $nasabah->kecamatan }}"
                            class="form-control" required>
                        @error('kecamatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kabupaten</label>
                        <input id="kabupaten" name="kabupaten" type="text" value="{{ $nasabah->kabupaten }}"
                            class="form-control" required>
                        @error('kabupaten')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Propinsi</label>
                        <input id="propinsi" name="propinsi" type="text" value="{{ $nasabah->propinsi }}"
                            class="form-control" required>
                        @error('propinsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ $nasabah->tempat_lahir }}" class="form-control"
                            required>
                        @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ $nasabah->tanggal_lahir }}"
                            class="form-control" required>
                        @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" value="{{ $nasabah->telepon }}" class="form-control" required>
                        @error('telepon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto KTP/SIM</label>
                        <input type="file" name="foto_ktp_sim" class="form-control" required accept="image/*"
                            id="foto_ktp_sim_input" onchange="previewFoto()">
                        @if ($nasabah->foto_ktp_sim)
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" id="confirmEditSubmit">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
                        data-bs-target="#editConfirmModal">Perbarui Data</button>
                    <a href="{{ url('admin/nasabah') }}" class="btn btn-secondary w-20">Kembali</a>
                </form>
            </div>
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
@endsection --}}
