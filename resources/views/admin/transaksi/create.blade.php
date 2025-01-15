{{-- @extends('admin.layouts.app')

@section('title', 'Create Transaksi')

@section('contents')
    <div class="content">
        <div class="container">
            <h1>Buat Transaksi Baru</h1>
            <form action="{{ route('admin.transaksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nasabah_id">Pilih Nasabah</label>
                    <select name="nasabah_id" id="nasabah_id" class="form-select" required>
                        <option value="">-- Pilih Nasabah --</option>
                        @foreach($nasabah as $n)
                            <option value="{{ $n->id }}">{{ $n->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Pengajuan Pinjaman:</label>
                    <input type="text" name="pengajuan_pinjaman" id="pengajuan_pinjaman" class="form-control"
                        value="{{ old('pengajuan_pinjaman') }}" required>
                    @error('pengajuan_pinjaman')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jangka Waktu:</label>
                    <input type="text" name="jangka_waktu" class="form-control" value="{{ old('jangka_waktu') }}"
                        required>
                    @error('jangka_waktu')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jenis Jaminan:</label>
                    <input type="text" name="jenis_jaminan" class="form-control" value="{{ old('jenis_jaminan') }}"
                        required>
                    @error('jenis_jaminan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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

        // Fungsi untuk memformat angka menjadi format Rupiah
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        // Event listener untuk memformat input pengajuan pinjaman
        document.getElementById('pengajuan_pinjaman').addEventListener('keyup', function(e) {
            this.value = formatRupiah(this.value, 'Rp ');
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
@endsection --}}
