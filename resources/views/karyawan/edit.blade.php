@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('contents')
    <div class="content">
        <h1 class="fw-bold fs-3 text-center">Edit Data Karyawan</h1>
        <div class="pb-4">
            <div class="mt-4">
                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input id="nama_lengkap" name="nama_lengkap" type="text"
                            value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" class="form-control" required>
                        @error('nama_lengkap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIP <span class="text-danger">*</span></label>
                        <input type="text" id="nip" name="nip" value="{{ $karyawan->nip }}" class="form-control"
                            required>
                        @error('nip')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Identitas <span class="text-danger">*</span></label>
                        <input id="no_identitas" name="no_identitas" type="text" value="{{ $karyawan->no_identitas }}"
                            class="form-control" required>
                        @error('no_identitas')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Posisi Pekerjaan <span class="text-danger">*</span></label>
                        <select name="pekerjaan_id" class="form-select" required>
                            <option value="" disabled>Pilih Posisi Pekerjaan</option>
                            @foreach ($pekerjaans as $pekerjaan)
                                <option value="{{ $pekerjaan->id }}"
                                    {{ old('pekerjaan_id', $karyawan->pekerjaan_id) == $pekerjaan->id ? 'selected' : '' }}>
                                    {{ $pekerjaan->posisi_pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                        @error('pekerjaan_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}" class="form-control" required>
                            @error('tempat_lahir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" class="form-control" required>
                            @error('tanggal_lahir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class="form-select" required>
                            <option value="Islam" {{ old('agama', $karyawan->agama) == 'Islam' ? 'selected' : '' }}>
                                Islam
                            </option>
                            <option value="Kristen Protestan"
                                {{ old('agama', $karyawan->agama) == 'Kristen Protestan' ? 'selected' : '' }}>Kristen
                                Protestan</option>
                            <option value="Kristen Katolik"
                                {{ old('agama', $karyawan->agama) == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik
                            </option>
                            <option value="Hindu" {{ old('agama', $karyawan->agama) == 'Hindu' ? 'selected' : '' }}> Hindu
                            </option>
                            <option value="Buddha" {{ old('agama', $karyawan->agama) == 'Buddha' ? 'selected' : '' }}>
                                Buddha</option>
                            <option value="Konghucu" {{ old('agama', $karyawan->agama) == 'Konghucu' ? 'selected' : '' }}>
                                Konghucu</option>
                            <option value="Atheis" {{ old('agama', $karyawan->agama) == 'Atheis' ? 'selected' : '' }}>
                                Atheis</option>
                        </select>
                        @error('agama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                        <input type="text" name="kewarganegaraan"
                            value="{{ old('kewarganegaraan', $karyawan->kewarganegaraan) }}" class="form-control" required>
                        @error('kewarganegaraan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                        <select name="status_perkawinan" class="form-select" required>
                            <option value="Belum Menikah"
                                {{ old('status_perkawinan', $karyawan->status_perkawinan) == 'Belum Menikah' ? 'selected' : '' }}>
                                Belum Menikah</option>
                            <option value="Menikah"
                                {{ old('status_perkawinan', $karyawan->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>
                                Menikah</option>
                        </select>
                        @error('status_perkawinan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $karyawan->no_telepon) }}"
                            class="form-control" required>
                        @error('no_telepon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Email :</label>
                        <input type="email" name="email" value="{{ old('email', $karyawan->email) }}"
                            class="form-control" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat_lengkap" placeholder="Alamat Lengkap" rows="3" class="form-control" required>{{ old('alamat_lengkap', $karyawan->alamat_lengkap) }}</textarea>
                        @error('alamat_lengkap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                        <input id="kode_pos" name="kode_pos" type="text" value="{{ $karyawan->kode_pos }}"
                            class="form-control" required>
                        @error('kode_pos')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Anggota Keluarga Repeater -->
                    {{-- <div class="mb-3">
                        <label class="form-label">Anggota Keluarga:</label>
                        <div id="anggotaKeluargaContainer">
                            @foreach ($karyawan->anggotaKeluarga as $index => $anggota)
                                <div class="anggota-keluarga mb-3 border p-3" data-index="{{ $index }}">
                                    <input type="hidden" name="anggota_keluarga[{{ $index }}][id]"
                                        value="{{ $anggota->id }}">
                                    <div class="mb-2">
                                        <label class="form-label">Status Kekeluargaan</label>
                                        <select name="anggota_keluarga[{{ $index }}][status_kekeluargaan]"
                                            class="form-select" required>
                                            <option value="Kepala Keluarga"
                                                {{ $anggota->status_kekeluargaan == 'Kepala Keluarga' ? 'selected' : '' }}>
                                                Kepala Keluarga</option>
                                            <option value="Istri"
                                                {{ $anggota->status_kekeluargaan == 'Istri' ? 'selected' : '' }}>Istri
                                            </option>
                                            <option value="Anak"
                                                {{ $anggota->status_kekeluargaan == 'Anak' ? 'selected' : '' }}>Anak
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="anggota_keluarga[{{ $index }}][nama]"
                                            class="form-control" value="{{ $anggota->nama }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">NIK</label>
                                        <input type="text" name="anggota_keluarga[{{ $index }}][nik]"
                                            class="form-control" value="{{ $anggota->nik }}" required>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" id="addAnggotaKeluarga">Tambah Anggota
                            Keluarga</button>
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Foto KTP <span class="text-danger">*</span></label>
                        <input type="file" name="foto_ktp" class="form-control" accept="image/*" id="foto_ktp_input"
                            onchange="previewFoto('foto_ktp_input', 'foto_ktp_preview')">

                        @if ($karyawan->foto_ktp)
                            <img id="foto_ktp_preview" src="{{ asset('storage/' . $karyawan->foto_ktp) }}"
                                alt="Foto KTP" class="img-fluid mt-2" style="max-width: 150px;">
                        @endif

                        @error('foto_ktp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Foto KK :</label>
                        <input type="file" name="foto_kk" class="form-control" accept="image/*" id="foto_kk_input"
                            onchange="previewFoto('foto_kk_input', 'foto_kk_preview')">

                        @if ($karyawan->foto_kk)
                            <img id="foto_kk_preview" src="{{ asset('storage/' . $karyawan->foto_kk) }}" alt="Foto KK"
                                class="img-fluid mt-2" style="max-width: 150px;">
                        @endif

                        @error('foto_kk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

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
                                    Apakah Anda yakin ingin mengubah data ini?
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
                    <a href="{{ url('karyawan') }}" class="btn btn-secondary w-20">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('confirmEditSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     let index =
        //         {{ $karyawan->anggotaKeluarga->count() }}; // Mendapatkan jumlah anggota keluarga yang sudah ada

        //     // Tambah Anggota Keluarga
        //     document.getElementById('addAnggotaKeluarga').addEventListener('click', function() {
        //         const container = document.getElementById('anggotaKeluargaContainer');
        //         const newAnggota = document.createElement('div');
        //         newAnggota.classList.add('anggota-keluarga', 'mb-3', 'border', 'p-3');
        //         newAnggota.setAttribute('data-index', index); // Set index untuk anggota baru

        //         newAnggota.innerHTML = `
        //     <div class="mb-2">
        //         <label class="form-label">Status Kekeluargaan</label>
        //         <select name="anggota_keluarga[${index}][status_kekeluargaan]" class="form-select" required>
        //             <option value="" disabled selected>Pilih Status Kekeluargaan</option>
        //             <option value="Kepala Keluarga">Kepala Keluarga</option>
        //             <option value="Istri">Istri</option>
        //             <option value="Anak">Anak</option>
        //         </select>
        //     </div>
        //     <div class="mb-2">
        //         <label class="form-label">Nama</label>
        //         <input type="text" name="anggota_keluarga[${index}][nama]" class="form-control" placeholder="Nama" required>
        //     </div>
        //     <div class="mb-2">
        //         <label class="form-label">NIK</label>
        //         <input type="text" name="anggota_keluarga[${index}][nik]" class="form-control" placeholder="NIK" required>
        //     </div>
        //     <button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button>
        // `;

        //         container.appendChild(newAnggota);
        //         index++; // Increment index untuk anggota keluarga berikutnya
        //     });

        //     // Hapus Anggota Keluarga
        //     document.getElementById('anggotaKeluargaContainer').addEventListener('click', function(event) {
        //         if (event.target.classList.contains('remove-anggota')) {
        //             event.target.closest('.anggota-keluarga').remove();
        //             index--; // Decrement index saat anggota keluarga dihapus
        //         }
        //     });
        // });

        function previewFoto(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            const file = input.files[0]; // Mengambil file yang diupload
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Mengubah src dari gambar preview dengan file baru
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(file); // Membaca file sebagai URL data
            } else {
                // Jika tidak ada file, kembalikan ke gambar lama
                preview.src = "{{ asset('storage/' . $karyawan->foto_ktp) }}"; // untuk KTP
                preview.src = "{{ asset('storage/' . $karyawan->foto_kk) }}"; // untuk KK
            }
        }
    </script>
@endsection
