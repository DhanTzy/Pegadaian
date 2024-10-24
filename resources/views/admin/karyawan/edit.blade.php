@extends('admin.layouts.app')

@section('title', 'Edit Karyawan')

@section('contents')
    <h1 class="fw-bold fs-3 text-center">Edit Data Karyawan</h1>
    <div class="pb-4">
        <div class="mt-4">
            <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap :</label>
                    <input id="nama_lengkap" name="nama_lengkap" type="text"
                        value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}" class="form-control" required>
                    @error('nama_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Posisi Pekerjaan :</label>
                    <select name="posisi_pekerjaan" class="form-select" required>
                        <option value="Manager"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Manager' ? 'selected' : '' }}>
                            Manager</option>
                        <option value="Administrasi"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Administrasi' ? 'seleted' : '' }}>
                            Administrasi</option>
                        <option value="Supervisor"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Supervisor' ? 'selected' : '' }}>
                            Supervisor</option>
                        <option value="Marketing Officer"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Marketing Officer' ? 'selected' : '' }}>
                            Marketing Officer</option>
                        <option value="Collection Officer"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Collection Officer' ? 'selected' : '' }}>
                            Collection Officer</option>
                        <option value="Kasir"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Kasir' ? 'selected' : '' }}>Kasir
                        </option>
                        <option value="Customer Service"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Customer Service' ? 'selected' : '' }}>
                            Customer Service</option>
                        <option value="Teller"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Teller' ? 'selected' : '' }}>Teller
                        </option>
                        <option value="Security"
                            {{ old('posisi_pekerjaan', $karyawan->posisi_pekerjaan) == 'Security' ? 'selected' : '' }}>
                            Security</option>
                    </select>
                    @error('posisi_pekerjaan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin :</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="Laki-laki"
                            {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Perempuan"
                            {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Tempat Lahir :</label>
                        <input type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}" class="form-control" required>
                        @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Tanggal Lahir :</label>
                        <input type="date" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" class="form-control" required>
                        @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Agama :</label>
                    <input type="text" name="agama" value="{{ old('agama', $karyawan->agama) }}" class="form-control"
                        required>
                    @error('agama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kewarganegaraan :</label>
                    <input type="text" name="kewarganegaraan"
                        value="{{ old('kewarganegaraan', $karyawan->kewarganegaraan) }}" class="form-control" required>
                    @error('kewarganegaraan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Perkawinan :</label>
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
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon :</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $karyawan->no_telepon) }}"
                        class="form-control" required>
                    @error('no_telepon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email :</label>
                    <input type="email" name="email" value="{{ old('email', $karyawan->email) }}" class="form-control"
                        required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap :</label>
                    <textarea name="alamat_lengkap" placeholder="Alamat Lengkap" rows="3" class="form-control" required>{{ old('alamat_lengkap', $karyawan->alamat_lengkap) }}</textarea>
                    @error('alamat_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Pos :</label>
                    <input id="kode_pos" name="kode_pos" type="text" value="{{ $karyawan->kode_pos }}"
                        class="form-control" required>
                    @error('kode_pos')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Riwayat Pendidikan -->
                <label class="form-label">Riwayat Pendidikan :</label>
                <div id="riwayat-pendidikan-container">
                    @foreach ($karyawan->riwayatPendidikan as $index => $pendidikan)
                        <div class="riwayat-pendidikan-item mb-3">
                            <h5>Riwayat Pendidikan {{ $index + 1 }}</h5>
                            <div class="mb-2">
                                <label class="form-label">Pendidikan :</label>
                                <input type="hidden" name="riwayat_pendidikan[{{ $index }}][id]"
                                    value="{{ $pendidikan->id }}">
                                <select name="riwayat_pendidikan[{{ $index }}][pendidikan]" class="form-select" required>
                                    <option value=""
                                        {{ old("riwayat_pendidikan.$index.pendidikan", $pendidikan->pendidikan) == null ? 'selected' : '' }}>
                                        Pilih Pendidikan</option>
                                    <option value="SD"
                                        {{ old("riwayat_pendidikan.$index.pendidikan", $pendidikan->pendidikan) == 'SD' ? 'selected' : '' }}>
                                        SD</option>
                                    <option value="SMP"
                                        {{ old("riwayat_pendidikan.$index.pendidikan", $pendidikan->pendidikan) == 'SMP' ? 'selected' : '' }}>
                                        SMP</option>
                                    <option value="SMA"
                                        {{ old("riwayat_pendidikan.$index.pendidikan", $pendidikan->pendidikan) == 'SMA' ? 'selected' : '' }}>
                                        SMA</option>
                                    <option value="SMK"
                                        {{ old("riwayat_pendidikan.$index.pendidikan", $pendidikan->pendidikan) == 'SMK' ? 'selected' : '' }}>
                                        SMK</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Jurusan :</label>
                                <input type="text" name="riwayat_pendidikan[{{ $index }}][jurusan]"
                                    class="form-control"
                                    value="{{ old("riwayat_pendidikan.$index.jurusan", $pendidikan->jurusan) }}"
                                    placeholder="Jurusan">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Jenjang Pendidikan :</label>
                                <select name="riwayat_pendidikan[{{ $index }}][jenjang_pendidikan]"
                                    class="form-select">
                                    <option value=""
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == null ? 'selected' : '' }}>
                                        Pilih Jenjang Pendidikan</option>
                                    <option value="D1"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'D1' ? 'selected' : '' }}>
                                        D1</option>
                                    <option value="D2"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'D2' ? 'selected' : '' }}>
                                        D2</option>
                                    <option value="D3"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'D3' ? 'selected' : '' }}>
                                        D3</option>
                                    <option value="D4"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'D4' ? 'selected' : '' }}>
                                        D4</option>
                                    <option value="S1"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'S1' ? 'selected' : '' }}>
                                        S1</option>
                                    <option value="S2"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'S2' ? 'selected' : '' }}>
                                        S2</option>
                                    <option value="S3"
                                        {{ old("riwayat_pendidikan.$index.jenjang_pendidikan", $pendidikan->jenjang_pendidikan) == 'S3' ? 'selected' : '' }}>
                                        S3</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Tahun Lulus :</label>
                                <input type="number" name="riwayat_pendidikan[{{ $index }}][tahun_lulus]"
                                    class="form-control" required
                                    value="{{ old("riwayat_pendidikan.$index.tahun_lulus", $pendidikan->tahun_lulus) }}"
                                    placeholder="Tahun Lulus">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Nilai IPk :</label>
                                <input type="number" name="riwayat_pendidikan[{{ $index }}][ipk_nilai]"
                                    class="form-control"
                                    value="{{ old("riwayat_pendidikan.$index.ipk_nilai", $pendidikan->ipk_nilai) }}"
                                    placeholder="Nilai IPK">
                            </div>
                            <button type="button" class="btn btn-danger"
                                onclick="removeRiwayatPendidikan(this)">Hapus</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mb-3" onclick="addRiwayatPendidikan()">Tambah Riwayat
                    Pendidikan</button>

                <div class="mb-3">
                    <label class="form-label">Foto KTP :</label>
                    <input type="file" name="foto_ktp" class="form-control" accept="image/*" id="foto_ktp_input"
                        onchange="previewFoto('foto_ktp_input', 'foto_ktp_preview')">

                    @if ($karyawan->foto_ktp)
                        <img id="foto_ktp_preview" src="{{ asset('storage/' . $karyawan->foto_ktp) }}" alt="Foto KTP"
                            class="img-fluid mt-2" style="max-width: 150px;">
                    @endif

                    @error('foto_ktp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
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
                                Apakah Anda yakin ingin mengubah data ini?
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

        // Menambah riwayat pendidikan
        function addRiwayatPendidikan() {
            const container = document.getElementById('riwayat-pendidikan-container');
            const index = container.children.length;
            const newItem = `
                <div class="riwayat-pendidikan-item mb-3">
                    <h5>Riwayat Pendidikan ${index + 1}</h5>
                    <div class="mb-2">
                        <input type="hidden" name="riwayat_pendidikan[{{ $index }}][id]" value="{{ $pendidikan->id }}">
                        <label class="form-label">Pendidikan :</label>
                        <select name="riwayat_pendidikan[${index}][pendidikan]" class="form-select" required>
                             <option value="">Pilih Pendidikan</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jurusan :</label>
                        <input type="text" name="riwayat_pendidikan[${index}][jurusan]" class="form-control" placeholder="Jurusan">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jenjang Pendidikan :</label>
                        <select name="riwayat_pendidikan[${index}][jenjang_pendidikan]" class="form-select">
                            <option value="">Pilih Jenjang Pendidikan</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Tahun Lulus :</label>
                        <input type="number" name="riwayat_pendidikan[${index}][tahun_lulus]" class="form-control" placeholder="Tahun Lulus" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nilai IPK :</label>
                        <input type="number" name="riwayat_pendidikan[${index}][ipk_nilai]" class="form-control" placeholder="Nilai IPK">
                    </div>
                    <button type="button" class="btn btn-danger" onclick="removeRiwayatPendidikan(this)">Hapus</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newItem);
        }

        // Menghapus riwayat pendidikan
        function removeRiwayatPendidikan(element) {
            const item = element.closest('.riwayat-pendidikan-item');
            item.remove();
        }
    </script>
@endsection
