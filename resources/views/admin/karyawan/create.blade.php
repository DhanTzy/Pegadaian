@extends('layouts.app')

@section('title', 'Create Karyawan')

@section('contents')
    <h1 class="fw-bold fs-3 text-center">Input Data Karyawan</h1>
    <div class="mb-4 pb-4 border-bottom">
        <form action="{{ route('admin.karyawan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap :</label>
                <input id="nama_lengkap" name="nama_lengkap" type="text" class="form-control"
                    value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap Anda" required>
                @error('nama_lengkap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Posisi Pekerjaan :</label>
                <select name="posisi_pekerjaan" class="form-select" required>
                    <option value="" disable selected>Pilih Posisi Pekerjaan</option>
                    <option value="Manager" {{ old('posisi_pekerjaan') == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Administrasi" {{ old('posisi_pekerjaan') == 'Administrasi' ? 'selected' : '' }}>
                        Administrasi</option>
                    <option value="Supervisor" {{ old('posisi_pekerjaan') == 'Supervisor' ? 'selected' : '' }}>Supervisor
                    </option>
                    <option value="Marketing Officer"
                        {{ old('posisi_pekerjaan') == 'Marketing Officer' ? 'selected' : '' }}>Marketing Officer</option>
                    <option value="Collection Officer"
                        {{ old('posisi_pekerjaan') == 'Collection Officer' ? 'selected' : '' }}>Collection Officer</option>
                    <option value="Kasir" {{ old('posisi_pekerjaan') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="Customer Service" {{ old('posisi_pekerjaan') == 'Customer Service' ? 'selected' : '' }}>
                        Customer Service</option>
                    <option value="Teller" {{ old('posisi_pekerjaan') == 'Teller' ? 'selected' : '' }}>Teller</option>
                    <option value="Security" {{ old('posisi_pekerjaan' == 'Security' ? 'selected' : '') }}>Security
                    </option>
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
                <input type="text" name="agama" class="form-control" value="{{ old('agama') }}"
                    placeholder="Agama Anda" required>
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
                    <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum
                        Menikah</option>
                    <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
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

            <div class="mb-3">
                <label class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                    placeholder="Email Anda" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

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

            <!-- Input Riwayat Pendidikan -->
            <label class="form-label">Riwayat Pendidikan :</label>
            <div id="riwayat-pendidikan-container">
                <div class="riwayat-pendidikan-item mb-3">
                    <h5>Riwayat Pendidikan 1</h5>
                    <div class="mb-2">
                        <label class="form-label">Pendidikan :</label>
                        <select name="riwayat_pendidikan[0][pendidikan]" class="form-select" required>
                            <option value="">Pilih Pendidikan</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jurusan :</label>
                        <input type="text" name="riwayat_pendidikan[0][jurusan]" class="form-control"
                            placeholder="Jurusan">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jenjang Pendidikan :</label>
                        <select name="riwayat_pendidikan[0][jenjang_pendidikan]" class="form-select">
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
                        <input type="text" name="riwayat_pendidikan[0][tahun_lulus]" class="form-control"
                            placeholder="Tahun Lulus" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">IPK Nilai :</label>
                        <input type="text" name="riwayat_pendidikan[0][ipk_nilai]" class="form-control"
                            placeholder="IPK Nilai">
                    </div>
                    <button type="button" class="btn btn-danger hapus-riwayat"
                        onclick="hapusRiwayat(this)">Hapus</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="tambah-riwayat">Tambah Riwayat Pendidikan</button>

            <div class="mb-3">
                <label class="form-label">Foto KTP :</label>
                <input type="file" name="foto_ktp" class="form-control" accept="image/*" id="foto_ktp_input"
                    onchange="previewKTP()">
                <img id="foto_ktp_preview" class="img-fluid mt-2" style="max-width: 150px; display: none;">
                @error('foto_ktp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto KK :</label>
                <input type="file" name="foto_kk" class="form-control" accept="image/*" id="foto_kk_input"
                    onchange="previewKK()">
                <img id="foto_kk_preview" class="img-fluid mt-2" style="max-width: 150px; display: none;">
                @error('foto_kk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

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
            <button type="button" class="btn btn-primary w-20" data-bs-toggle="modal"
                data-bs-target="#confirmModal">Tambah Data
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary w-20">Kembali</a>
        </form>
    </div>

    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        document.getElementById('tambah-riwayat').addEventListener('click', function() {
            const container = document.getElementById('riwayat-pendidikan-container');
            const index = container.children.length;

            const newItem = document.createElement('div');
            newItem.className = 'riwayat-pendidikan-item mb-3';
            newItem.innerHTML = `
                <h5>Riwayat Pendidikan ${index + 1}</h5>
                <div class="mb-2">
                    <label class="form-label">Pendidikan :</label>
                    <select name="riwayat_pendidikan[${index}][pendidikan]" class="form-select" required>
                        <option value="">Pilih Pendidikan</option>
                        <option value="SD">SD</ option>
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
                    <input type="text" name="riwayat_pendidikan[${index}][tahun_lulus]" class="form-control" placeholder="Tahun Lulus" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">IPK Nilai :</label>
                    <input type="text" name="riwayat_pendidikan[${index}][ipk_nilai]" class="form-control" placeholder="IPK Nilai">
                </div>
                <button type="button" class="btn btn-danger hapus-riwayat" onclick="hapusRiwayat(this)">Hapus</button>
            `;
            container.appendChild(newItem);
        });

        function hapusRiwayat(button) {
            const item = button.parentElement;
            item.remove();
        }

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
