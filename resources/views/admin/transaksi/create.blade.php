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
                    <input type="text" name="jenis_agunan" class="form-control" value="{{ old('jenis_agunan') }}"
                        required>
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
                    <input type="text" name="nilai_likuiditas" class="form-control"
                        value="{{ old('nilai_likuiditas') }}" required readonly>
                    @error('nilai_likuiditas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Catatan Barang :</label>
                    <textarea type="text" name="catatan" class="form-control" required>{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                    <label for="pajak_id">Bulan</label>
                    <select name="pajak_id" id="pajak_id" class="form-control" onchange="updateBunga()">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach ($pajaks as $pajak)
                            <option value="{{ $pajak->id }}" data-bunga="{{ $pajak->bunga }}">
                                {{ $pajak->bulan }}
                            </option>
                        @endforeach
                    </select>
                    @error('pajak_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="bunga">Bunga</label>
                    <input type="text" id="bunga" class="form-control" placeholder="Bunga" readonly>
                </div>

                <div class="mb-3">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="per_bulan">Per Bulan</label>
                    <input type="text" id="per_bulan" class="form-control" placeholder="Per Bulan" readonly>
                </div>

                <div class="mb-3">
                    <label>Metode Pencairan:</label>
                    <select name="metode_pencairan" class="form-select" required onchange="toggleRekeningFields()">
                        <option value="" disabled selected>-- Pilih Metode --</option>
                        <option value="Cash" {{ old('metode_pencairan') == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Transfer" {{ old('metode_pencairan') == 'Transfer' ? 'selected' : '' }}>Transfer
                        </option>
                    </select>
                    @error('metode_pencairan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div id="rekeningFields" style="display: none;">
                    <div class="mb-3">
                        <label>Nomor Rekening:</label>
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

        // Input Pilih Bulan Otomatis Bunga Keisi %
        const pajak = @json($pajaks);

        function updateBunga() {
            const selected = document.querySelector('#pajak_id');
            const selectedOption = selected.options[selected.selectedIndex];
            const bunga = selectedOption.getAttribute('data-bunga');
            const bungaPersen = bunga ? parseFloat(bunga) / 100 : 0; // Konversi bunga menjadi persentase

            // Menampilkan bunga pada input
            document.querySelector('#bunga').value = bunga ? `${bunga}` : '';

            // Menghitung jumlah bayar berdasarkan nilai pinjaman yang dibatasi
            const pengajuanPinjamanInput = document.querySelector('input[name="pengajuan_pinjaman"]');
            const cleanedPinjaman = pengajuanPinjamanInput.value.replace(/[^0-9,-]+/g, ''); // Menghapus semua karakter non-numerik
            let jumlahPinjaman = parseFloat(cleanedPinjaman) || 0; // Konversi pengajuan pinjaman ke angka

            // Ambil nilai likuiditas
            const nilaiLikuiditasInput = document.querySelector('input[name="nilai_likuiditas"]').value;
            const cleanedLikuiditas = nilaiLikuiditasInput.replace(/[^0-9,-]+/g, ''); // Menghapus semua karakter non-numerik
            const nilaiLikuiditas = parseFloat(cleanedLikuiditas) || 0; // Konversi nilai likuiditas ke angka

            // Batasi jumlah pinjaman ke nilai likuiditas
            if (jumlahPinjaman > nilaiLikuiditas) {
                jumlahPinjaman = nilaiLikuiditas; // Batasi pinjaman ke nilai likuiditas
                pengajuanPinjamanInput.value = formatRupiah(jumlahPinjaman.toString(), 'Rp'); // Perbarui input pinjaman
            }

            // Menghitung jumlah bayar
            const jumlahBayar = jumlahPinjaman * (1 + bungaPersen); // Perhitungan jumlah bayar dengan bunga

            // Membulatkan jumlah bayar ke angka bulat dan menampilkannya dengan format Rupiah
            const roundedJumlahBayar = Math.round(jumlahBayar);
            document.querySelector('#jumlah_bayar').value = formatRupiah(roundedJumlahBayar.toString(), 'Rp');

            // Menghitung per bulan
            const jumlahBulan = selectedOption ? parseInt(selectedOption.value) : 0;
            let bayarPerBulan = jumlahBulan > 0 ? jumlahBayar / jumlahBulan : 0; // Perhitungan bayar per bulan

            // Pembulatan ke ribuan terdekat
            bayarPerBulan = Math.round(bayarPerBulan / 1000) * 1000; // Pembulatan ke ribuan terdekat

            // Menampilkan per bulan
            document.querySelector('#per_bulan').value = bayarPerBulan ?
                formatRupiah(bayarPerBulan.toFixed(0), 'Rp') : '';
        }
        document.querySelector('#pajak_id').addEventListener('change', updateBunga);
        document.querySelector('input[name="pengajuan_pinjaman"]').addEventListener('input', updateBunga);

        // Metode Pencairan : Cash > Transfer ( No.Rekening, Bank )
        document.addEventListener('DOMContentLoaded', function() {
            const metodePencairan = document.querySelector('select[name="metode_pencairan"]').value;
            toggleRekeningFields();
        });

        function toggleRekeningFields() {
            const metodePencairan = document.querySelector('select[name="metode_pencairan"]').value;
            const rekeningFields = document.getElementById('rekeningFields');
            const noRekeningInput = document.querySelector('input[name="no_rekening"]');
            const bankInput = document.querySelector('input[name="bank"]');

            if (metodePencairan === 'Transfer') {
                rekeningFields.style.display = 'block';
                noRekeningInput.setAttribute('required', 'required');
                bankInput.setAttribute('required', 'required');
            } else {
                rekeningFields.style.display = 'none';
                noRekeningInput.removeAttribute('required');
                bankInput.removeAttribute('required');
            }
        }

        // Fungsi untuk memformat angka menjadi format Rupiah
        function formatRupiah(angka, prefix) {
            if (!angka) return ''; // Jika angka kosong, balik dek string kosong
            const numberString = angka.replace(/[^,\d]/g, '').toString();
            const split = numberString.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa); // Ambil bagian awal angka

            const ribuan = split[0].substr(sisa).match(/\d{3}/g); // Ambil kelompok ribuan
            if (ribuan) {
                const separator = sisa ? '.' : ''; // Tambah titik jika ada sisa
                rupiah += separator + ribuan.join('.'); // Gabung semua kelompok ribuan
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah; // Tambahkan desimal jika ada
            return prefix ? prefix + ' ' + rupiah : rupiah;
        }
        document.querySelectorAll('input[name="pengajuan_pinjaman"], input[name="nilai_pasar"]').forEach(input => {
            input.addEventListener('input', function() {
                const value = this.value.replace(/\./g, ''); // Hapus titik sebelumnya
                this.value = value ? formatRupiah(value, 'Rp') : ''; // Format hanya jika ada nilai
            });
        });

        // Nilai Likuiditas Dari Hasil Menginput Nilai Pasar
        function calculateNilaiLikuiditas() {
            const nilaiPasarInput = document.querySelector('input[name="nilai_pasar"]');
            const nilaiLikuiditasInput = document.querySelector('input[name="nilai_likuiditas"]');

            if (nilaiPasarInput.value) {
                const nilaiPasar = parseFloat(nilaiPasarInput.value.replace(/[^\d]/g, '')) || 0;
                const nilaiLikuiditas = nilaiPasar * 0.7; // Kalkulasi 70%
                nilaiLikuiditasInput.value = formatRupiah(nilaiLikuiditas.toFixed(0), 'Rp');
            } else {
                nilaiLikuiditasInput.value = ''; // Kosongkan jika tidak ada nilai pasar
            }
        }
        document.querySelector('input[name="pengajuan_pinjaman"]').addEventListener('input', function(e) {
            const pengajuanPinjamanInput = e.target;
            const nilaiLikuiditasInput = document.querySelector('input[name="nilai_likuiditas"]');

            // Ambil nilai likuiditas
            const nilaiLikuiditas = parseFloat(nilaiLikuiditasInput.value.replace(/[^\d]/g, '')) || 0;

            // Ambil nilai input pengajuan pinjaman
            let pengajuanPinjaman = parseFloat(pengajuanPinjamanInput.value.replace(/[^\d]/g, '')) || 0;

            // Jika nilai pengajuan melebihi nilai likuiditas
            if (pengajuanPinjaman > nilaiLikuiditas) {
                pengajuanPinjaman = nilaiLikuiditas; // Set ke nilai maksimum (nilai likuiditas)
                pengajuanPinjamanInput.value = formatRupiah(pengajuanPinjaman.toFixed(0),
                    'Rp'); // Format ulang ke Rupiah
            }
        });

        // Preview Foto Jaminan
        function previewImages(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = 'auto';
                    img.style.marginRight = '10px';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
