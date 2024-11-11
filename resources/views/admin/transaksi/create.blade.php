@extends('admin.layouts.app')

@section('title', 'Create Transaksi')

@section('contents')
<div class="content">
    <div class="container">
        <h1>Buat Transaksi Baru</h1>
        <form action="{{ route('admin.transaksi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Nasabah:</label>
                <input type="text" name="nama_nasabah" class="form-control" value="{{ old('nama_nasabah') }}" required>
                @error('nama_nasabah')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Metode Pencairan:</label>
                <select name="metode_pencairan" class="form-select" required onchange="toggleRekeningFields()">
                    <option value="">Pilih Metode</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                </select>
                @error('metode_pencairan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="rekeningFields" style="display: none;">
                <div class="mb-3">
                    <label>No Rekening:</label>
                    <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening') }}">
                    @error('no_rekening')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Bank:</label>
                    <input type="text" name="bank" class="form-control" value="{{ old('bank') }}">
                    @error('bank')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label>Pengajuan Pinjaman:</label>
                <input type="text" name="pengajuan_pinjaman" class="form-control"
                    value="{{ old('pengajuan_pinjaman') }}" required>
                @error('pengajuan_pinjaman')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Bunga (%):</label>
                <select id="bunga" name="bunga" class="form-select" required onchange="updateJangkaWaktu()">
                    <option value="">Pilih Bunga</option>
                    <option value="1.15%">1,15%</option>
                    <option value="4.15%">4,15%</option>
                    <option value="8.15%">8,15%</option>
                </select>
                @error('bunga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Jangka Waktu:</label>
                <select id="jangka_waktu" name="jangka_waktu" class="form-select" required>
                    <option value="">Pilih Jangka Waktu</option>
                    <option value="1 Bulan">1 Bulan</option>
                    <option value="4 Bulan">4 Bulan</option>
                    <option value="8 Bulan">8 Bulan</option>
                </select>
                @error('jangka_waktu')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Foto Jaminan:</label>
                <input type="file" name="foto_jaminan[]" class="form-control" multiple required accept="image/*"
                    onchange="previewImages(event)">
                @error('foto_jaminan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div id="image-preview" class="mt-3"></div>
            </div>

            <div class="mb-3">
                <label>Jenis Agunan :</label>
                <input type="text" name="jenis_agunan" class="form-control" value="{{ old('jenis_agunan') }}" required>
                @error('jenis_agunan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nilai Pasar Agunan :</label>
                <input type="text" name="nilai_pasar" class="form-control" value="{{ old('nilai_pasar') }}" required
                    oninput="calculateNilaiLikuiditas()">
                @error('nilai_pasar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nilai Likuiditas Agunan :</label>
                <input type="text" name="nilai_likuiditas" class="form-control" value="{{ old('nilai_likuiditas') }}"
                    required readonly>
                @error('nilai_likuiditas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Catatan :</label>
                <textarea type="text" name="catatan" class="form-control" required>{{ old('catatan') }}</textarea>
                @error('catatan')
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
                data-bs-target="#confirmModal">Tambah
                Data
            </button>
            <a href="{{ url('admin/transaksi') }}" class="btn btn-secondary w-20">Kembali</a>
        </form>
    </div>
</div>

    <script>
        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        function toggleRekeningFields() {
            const metodePencairan = document.querySelector('select[name="metode_pencairan"]').value;
            const rekeningFields = document.getElementById('rekeningFields');
            const noRekeningInput = document.querySelector('input[name="no_rekening"]');
            const bankInput = document.querySelector('input[name="bank"]');

            // Tampilkan atau sembunyikan field no_rekening dan bank
            if (metodePencairan === 'Transfer') {
                rekeningFields.style.display = 'block'; // Tampilkan field
                noRekeningInput.setAttribute('required', 'required'); // Tambahkan atribut required
                bankInput.setAttribute('required', 'required'); // Tambahkan atribut required
            } else {
                rekeningFields.style.display = 'none'; // Sembunyikan field
                noRekeningInput.removeAttribute('required'); // Hapus atribut required
                bankInput.removeAttribute('required'); // Hapus atribut required
            }
        }

        // Nilai Likuiditas
        function calculateNilaiLikuiditas() {
            const nilaiPasar = parseFloat(document.querySelector('input[name="nilai_pasar"]').value) || 0;
            const nilaiLikuiditas = (nilaiPasar * 0.7).toFixed(0); // Menghitung 70% dari nilai pasar
            document.querySelector('input[name="nilai_likuiditas"]').value = nilaiLikuiditas; // Update nilai likuiditas
        }

        function previewImages(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px'; // Set width of the image
                    img.style.height = 'auto'; // Maintain aspect ratio
                    img.style.marginRight = '10px'; // Space between images
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }

        function updateJangkaWaktu() {
            const bungaSelect = document.getElementById('bunga');
            const jangkaWaktuSelect = document.getElementById('jangka_waktu');

            // Reset semua opsi jangka waktu menjadi aktif
            Array.from(jangkaWaktuSelect.options).forEach(option => {
                option.disabled = false; // Enable all options
            });

            switch (bungaSelect.value) {
                case '1.15%':
                    jangkaWaktuSelect.value = '1 Bulan';
                    disableOtherOptions(jangkaWaktuSelect, ['4 Bulan', '8 Bulan']);
                    break;
                case '4.15%':
                    jangkaWaktuSelect.value = '4 Bulan';
                    disableOtherOptions(jangkaWaktuSelect, ['1 Bulan', '8 Bulan']);
                    break;
                case '8.15%':
                    jangkaWaktuSelect.value = '8 Bulan';
                    disableOtherOptions(jangkaWaktuSelect, ['1 Bulan', '4 Bulan']);
                    break;
                default:
                    jangkaWaktuSelect.value = ''; // Reset jangka waktu jika tidak ada pilihan
            }
        }

        function disableOtherOptions(selectElement, valuesToDisable) {
            valuesToDisable.forEach(value => {
                for (let i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === value) {
                        selectElement.options[i].disabled = true; // Disable the option
                    }
                }
            });
        }
    </script>
@endsection
