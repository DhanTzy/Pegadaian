@extends('layouts.app')

@section('title', 'Create Karyawan')

@section('contents')
    <div class="content">
        <h1 class="fw-bold fs-3 text-center">Input Data Karyawan</h1>
        <div class="mb-4 pb-4 border-bottom">
            <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') }}"
                        placeholder="Nomor Induk Pegawai" required>
                    @error('nip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Identitas (KTP)</label>
                    <input id="no_identitas" name="no_identitas" type="text" class="form-control"
                        value="{{ old('no_identitas') }}" placeholder="No Identitas Anda" required>
                    @error('no_identitas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap :</label>
                    <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control"
                        value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap Anda" required>
                    @error('nama_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pekerjaan_id">Posisi Pekerjaan</label>
                    <select name="pekerjaan_id" id="pekerjaan_id" class="form-select">
                        <option value="">Pilih Posisi Pekerjaan</option>
                        @foreach($pekerjaans as $pekerjaan)
                            <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id', $karyawan->pekerjaan_id ?? '') == $pekerjaan->id ? 'selected' : '' }}>
                                {{ $pekerjaan->posisi_pekerjaan }}
                            </option>
                        @endforeach
                    </select>
                    @error('posisi_pekerjaan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin :</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Tempat Lahir :</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}"
                            placeholder="Tempat Lahir Anda" required>
                        @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Tanggal Lahir :</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}"
                            required>
                        @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Agama :</label>
                    <select name="agama" class="form-select" required>
                        <option value="" disabled selected>Pilih Agama</option>
                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                        </option>
                        <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>
                            Kristen Protestan
                        <option value="Kristen Katolik" {{ old('agama') == 'Kristen Katolik' ? 'selected' : '' }}>Kristen
                            Katolik
                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha
                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                        <option value="Atheis" {{ old('agama') == 'Atheis' ? 'selected' : '' }}>Atheis
                        </option>
                    </select>
                    @error('agama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kewarganegaraan :</label>
                    <input type="text" name="kewarganegaraan" class="form-control" value="{{ old('kewarganegaraan') }}"
                        placeholder="Kewarganegaraan Anda" required>
                    @error('kewarganegaraan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Perkawinan :</label>
                    <select name="status_perkawinan" class="form-select" required>
                        <option value="" disabled selected>Pilih Status Perkawinan</option>
                        <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>
                            Belum
                            Menikah</option>
                        <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah
                        </option>
                    </select>
                    @error('status_perkawinan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon :</label>
                    <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}"
                        placeholder="Nomor Telepon Anda" required>
                    @error('no_telepon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">Email :</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="Email Anda" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap :</label>
                    <textarea name="alamat_lengkap" rows="3" class="form-control" placeholder="Alamat Anda" required>{{ old('alamat_lengkap') }}</textarea>
                    @error('alamat_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Pos</label>
                    <input name="kode_pos" type="text" class="form-control" value="{{ old('kode_pos') }}"
                        placeholder="Kode Pos Anda" required>
                    @error('kode_pos')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <h5>Data Anggota Keluarga</h5>
                    <div id="anggotaKeluargaContainer">
                        <div class="anggota-keluarga mb-3 border p-3" data-index="0">
                            <div class="mb-2">
                                <label class="form-label">Status Kekeluargaan</label>
                                <select name="anggota_keluarga[0][status_kekeluargaan]" class="form-select" required>
                                    <option value="" disabled selected>Pilih Status Kekeluargaan</option>
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nama</label>
                                <input type="text" name="anggota_keluarga[0][nama]" class="form-control"
                                    placeholder="Nama" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">NIK</label>
                                <input type="text" name="anggota_keluarga[0][nik]" class="form-control"
                                    placeholder="NIK" required>
                            </div>
                            @error('anggota_keluarga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="addAnggotaKeluarga">Tambah Anggota
                        Keluarga</button>
                </div> --}}

                <div class="mb-3">
                    <label class="form-label">Foto KTP :</label>
                    <input type="file" name="foto_ktp" class="form-control" accept="image/*" id="foto_ktp_input"
                        onchange="previewKTP()">
                    <img id="foto_ktp_preview" class="img-fluid mt-2" style="max-width: 150px; display: none;">
                    @error('foto_ktp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">Foto KK :</label>
                    <input type="file" name="foto_kk" class="form-control" accept="image/*" id="foto_kk_input"
                        onchange="previewKK()">
                    <img id="foto_kk_preview" class="img-fluid mt-2" style="max-width: 150px; display: none;">
                    @error('foto_kk')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menambah data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="confirmSubmit">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-20" style="background-color: #183354;" data-bs-toggle="modal"
                    data-bs-target="#confirmModal"><i class="bi bi-send"></i> Tambah Data
                </button>
                <a href="{{ url('karyawan') }}" class="btn btn-secondary w-20"><i class="bi bi-x-lg"></i> Batal</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     let index = 1; // Mulai dengan 1, karena yang pertama sudah ada di form HTML

        //     // Tambah Anggota Keluarga
        //     document.getElementById('addAnggotaKeluarga').addEventListener('click', function() {
        //         const container = document.getElementById('anggotaKeluargaContainer');
        //         const newAnggota = document.createElement('div');
        //         newAnggota.classList.add('anggota-keluarga', 'mb-3', 'border', 'p-3');
        //         newAnggota.setAttribute('data-index', index); // Set index untuk anggota baru

        //         newAnggota.innerHTML = `
        // <div class="mb-2">
        //     <label class="form-label">Status Kekeluargaan</label>
        //     <select name="anggota_keluarga[${index}][status_kekeluargaan]" class="form-select" required>
        //         <option value="" disabled selected>Pilih Status Kekeluargaan</option>
        //         <option value="Kepala Keluarga">Kepala Keluarga</option>
        //         <option value="Istri">Istri</option>
        //         <option value="Anak">Anak</option>
        //     </select>
        // </div>
        // <div class="mb-2">
        //     <label class="form-label">Nama</label>
        //     <input type="text" name="anggota_keluarga[${index}][nama]" class="form-control" placeholder="Nama" required>
        // </div>
        // <div class="mb-2">
        //     <label class="form-label">NIK</label>
        //     <input type="text" name="anggota_keluarga[${index}][nik]" class="form-control" placeholder="NIK" required>
        // </div>
        // <button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button>
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

        function previewKTP() {
            const input = document.getElementById('foto_ktp_input');
            const preview = document.getElementById('foto_ktp_preview');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Menampilkan gambar preview
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Sembunyikan gambar jika tidak ada file
            }
        }

        function previewKK() {
            const input = document.getElementById('foto_kk_input');
            const preview = document.getElementById('foto_kk_preview');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Menampilkan gambar preview
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Sembunyikan gambar jika tidak ada file
            }
        }
    </script>
@endsection
