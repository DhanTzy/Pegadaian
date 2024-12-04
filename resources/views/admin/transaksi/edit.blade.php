@extends('admin.layouts.app')

@section('title', 'Edit Transaksi')

@section('contents')
    <div class="content">
        <h1>Edit Data Transaksi</h1>
        <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Nasabah:</label>
                <input type="text" name="nama_nasabah" class="form-control"
                    value="{{ old('nama_nasabah', $transaksi->nama_nasabah) }}" required>
                @error('nama_nasabah')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $transaksi->tanggal) }}"
                    required>
                @error('tanggal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode_pencairan">Metode Pencairan</label>
                <select id="metode_pencairan" name="metode_pencairan" class="form-select" onchange="toggleRekeningFields()">
                    <option value="">Pilih Metode</option>
                    <option value="Transfer"
                        {{ old('metode_pencairan', $transaksi->metode_pencairan) == 'Transfer' ? 'selected' : '' }}>Transfer
                    </option>
                    <option value="Cash"
                        {{ old('metode_pencairan', $transaksi->metode_pencairan) == 'Cash' ? 'selected' : '' }}>Cash
                    </option>
                </select>
                @error('metode_pencairan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="rekeningFields"
                style="display: {{ old('metode_pencairan', $transaksi->metode_pencairan) == 'Transfer' ? 'block' : 'none' }}">
                <div class="mb-3">
                    <label for="no_rekening">Nomor Rekening</label>
                    <input type="text" id="no_rekening" name="no_rekening" class="form-control"
                        value="{{ old('no_rekening', $transaksi->no_rekening) }}"
                        {{ old('metode_pencairan', $transaksi->metode_pencairan) == 'Transfer' ? 'required' : '' }}>
                    @error('no_rekening')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="bank">Bank</label>
                    <input type="text" id="bank" name="bank" class="form-control"
                        value="{{ old('bank', $transaksi->bank) }}"
                        {{ old('metode_pencairan', $transaksi->metode_pencairan) == 'Transfer' ? 'required' : '' }}>
                    @error('bank')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label>Pengajuan Pinjaman:</label>
                <input type="text" name="pengajuan_pinjaman" class="form-control"
                    value="{{ old('pengajuan_pinjaman', $transaksi->pengajuan_pinjaman) }}" required>
                @error('pengajuan_pinjaman')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="pajak_id">Bulan</label>
                <select id="pajak_id" name="pajak_id" class="form-control" onchange="updateBunga()">
                    <option value="">Pilih Bulan</option>
                    @foreach ($pajaks as $pajak)
                        <option value="{{ $pajak->id }}" data-bunga="{{ $pajak->bunga }}"
                            {{ old('pajak_id', $transaksi->pajak_id) == $pajak->id ? 'selected' : '' }}>
                            {{ $pajak->bulan }}
                        </option>
                    @endforeach
                </select>
                @error('pajak_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="bunga">Bunga</label>
                <input type="text" id="bunga" name="bunga" class="form-control"
                       value="{{ old('bunga', $transaksi->bunga) }}" readonly>
                @error('bunga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Foto Jaminan:</label>
                <input type="file" name="foto_jaminan[]" class="form-control" multiple accept="image/*"
                    onchange="previewImages(event)">
                @error('foto_jaminan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div id="image-preview" class="mt-3">
                    @foreach ($transaksi->jaminan as $jaminan)
                        <img src="{{ asset('storage/' . $jaminan->foto_jaminan) }}"
                            style="width: 100px; margin-right: 10px;">
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label>Jenis Agunan :</label>
                <input type="text" name="jenis_agunan" class="form-control"
                    value="{{ old('jenis_agunan', $transaksi->jenis_agunan) }}" required>
                @error('jenis_agunan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nilai Pasar Agunan :</label>
                <input type="text" name="nilai_pasar" class="form-control"
                    value="{{ old('nilai_pasar', $transaksi->nilai_pasar) }}" required
                    oninput="calculateNilaiLikuiditas()">
                @error('nilai_pasar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nilai Likuiditas Agunan :</label>
                <input type="text" name="nilai_likuiditas" class="form-control"
                    value="{{ old('nilai_likuiditas', $transaksi->nilai_likuiditas) }}" required readonly>
                @error('nilai_likuiditas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>Catatan :</label>
                <textarea name="catatan" class="form-control">{{ $transaksi->catatan }}</textarea>
                @error('catatan')
                    <div class="text-">{{ $message }}</div>
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
            <a href="{{ url('admin/transaksi') }}" class="btn btn-secondary w-20">Kembali</a>
        </form>
    </div>

    <script>
        document.getElementById('confirmEditSubmit').addEventListener('click', function() {
            document.querySelector('form').submit();
        });

        // Input Pilih Bulan Otomatis Bunga Keisi %
        const pajak = @json($pajaks);

        function updateBunga() {
            const selected = document.querySelector('#pajak_id');
            const bunga = selected.options[selected.selectedIndex].getAttribute('data-bunga');
            document.querySelector('#bunga').value = bunga ? `${bunga}%` : '';
        }

        // Mengisi nilai bunga awal berdasarkan bulan yang sudah dipilih
        document.addEventListener('DOMContentLoaded', () => {
            updateBunga();
        });

        // METODE PENCAIRAN
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
            if (!angka) return ''; // Jika angka kosong, kembalikan string kosong
            const numberString = angka.replace(/[^,\d]/g, '').toString();
            const split = numberString.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa); // Ambil bagian awal angka

            const ribuan = split[0].substr(sisa).match(/\d{3}/g); // Ambil kelompok ribuan
            if (ribuan) {
                const separator = sisa ? '.' : ''; // Tambahkan titik jika ada sisa
                rupiah += separator + ribuan.join('.'); // Gabungkan semua kelompok ribuan
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah; // Tambahkan desimal jika ada
            return prefix ? prefix + ' ' + rupiah : rupiah;
        }

        // Tambahkan event listener untuk format Rupiah
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
        // Event listener untuk perhitungan nilai likuiditas
        document.querySelector('input[name="nilai_pasar"]').addEventListener('input', calculateNilaiLikuiditas);

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
