@extends('\layouts.app')

@section('title', 'Home Transaksi List')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Daftar Pengajuan Pinjaman</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-content">
                    <div class="card mb-4">
                        <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                            <p class="fw-bold" id="current-info" style="margin: 0; font-size: 16px; color:red"></p>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary float-left mb-2" data-bs-toggle="modal"
                                data-bs-target="#transaksiModal" style="background-color : #0095FF;"><i class="bi bi-plus-lg"></i>
                                Tambah Pengajuan Pinjaman
                            </button>

                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="transaksiTable" class="table table-striped table-bordered">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Debitur</th>
                                            <th>Pengajuan Pinjaman</th>
                                            <th>Jangka Waktu</th>
                                            <th>Jenis Jaminan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <!-- Data will be loaded here via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaksiModalLabel">Buat Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nasabah_id">Pilih Debitur <span class="text-danger">*</span></label>
                            <select name="nasabah_id" id="nasabah_id" class="form-select" required>
                                <option value="">-- Pilih Debitur --</option>
                                @foreach ($nasabah as $n)
                                    <option value="{{ $n->id }}" {{ old('nasabah_id') == $n->id ? 'selected' : '' }}>
                                        {{ $n->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nasabah_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Pengajuan Pinjaman <span class="text-danger">*</span></label>
                            <input type="text" name="pengajuan_pinjaman" id="pengajuan_pinjaman" class="form-control"
                                value="{{ old('pengajuan_pinjaman') }}" required>
                            @error('pengajuan_pinjaman')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3"> 
                            <label>Jangka Waktu <span class="text-danger">*</span></label> 
                            <input type="text" name="jangka_waktu" id="jangka_waktu" class="form-control" 
                                value="{{ old('jangka_waktu') }}" required>
                            @error('jangka_waktu') 
                                <div class="text-danger">{{ $message }}</div>
                            @enderror 
                        </div>

                        <div class="mb-3">
                            <label>Jenis Jaminan <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_jaminan" class="form-control"
                                value="{{ old('jenis_jaminan') }}" required>
                            @error('jenis_jaminan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                            <button type="submit" class="btn btn-primary" style="background-color: #183354;" onclick="return confirmSave()"><i class="bi bi-send"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="transaksiDetailModal" tabindex="-1" aria-labelledby="transaksiDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaksiDetailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Debitur :</strong> <span id="detailNamaNasabah"></span></p>
                    <p><strong>Pengajuan Pinjaman :</strong> <span id="detailPengajuanPinjaman"></span></p>
                    <p><strong>Jangka Waktu :</strong> <span id="detailJangkaWaktu"></span></p>
                    <p><strong>Jenis Jaminan :</strong> <span id="detailJenisJaminan"></span></p>
                    <p><strong>Foto Jaminan :</strong> <span id="detailFotoJaminan"></span></p>
                    <p><strong>Nilai Pasar :</strong> <span id="detailNilaiPasar"></span></p>
                    <p><strong>Nilai Likuiditas :</strong> <span id="detailNilaiLikuiditas"></span></p>
                    <p><strong>Putusan Pinjaman :</strong> <span id="detailPutusanPinjaman"></span></p>
                    <p><strong>Bunga :</strong> <span id="detailBunga"></span></p>
                    <p><strong>Bunga Perbulan :</strong> <span id="detailBungaPerbulan"></span></p>
                    <p><strong>Pelunasan :</strong> <span id="detailPelunasan"></span></p>
                    <p><strong>Biaya Administrasi :</strong> <span id="detailBiayaAdministrasi"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        function updateTime() {
            const now = new Date();
            const dayString = now.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            const dateString = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const fullString = `${dayString}, ${dateString}, ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();

        $(document).ready(function() {
            var table = $('#transaksiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('transaksi.data') }}',
                },
                columns: [{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nasabah', name: 'nasabah' },
                    { data: 'pengajuan_pinjaman', name: 'pengajuan_pinjaman' },
                    { data: 'jangka_waktu', name: 'jangka_waktu' },
                    { data: 'jenis_jaminan', name: 'jenis_jaminan' },
                    { data: 'status_transaksi', name: 'status_transaksi' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        });

        var transaksiDetailModal = document.getElementById('transaksiDetailModal');
        transaksiDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var namaNasabah = button.getAttribute('data-nasabah_id')
            var pengajuanPinjaman = button.getAttribute('data-pengajuan_pinjaman');
            var jangkaWaktu = button.getAttribute('data-jangka_waktu');
            var jenisJaminan = button.getAttribute('data-jenis_jaminan');
            var nilaiPasar = button.getAttribute('data-nilai_pasar');
            var nilaiLikuiditas = button.getAttribute('data-nilai_likuiditas');
            var putusanPinjaman = button.getAttribute('data-putusan_pinjaman');
            var bunga = button.getAttribute('data-bunga');
            var bungaPerbulan = button.getAttribute('data-bunga_perbulan');
            var pelunasan = button.getAttribute('data-pelunasan');
            var biayaAdministrasi = button.getAttribute('data-biaya_administrasi');
            var fotoJaminan = button.getAttribute('data-foto_jaminan');

            document.querySelector('#detailNamaNasabah').textContent = namaNasabah;
            document.querySelector('#detailPengajuanPinjaman').textContent = pengajuanPinjaman;
            document.querySelector('#detailJangkaWaktu').textContent = jangkaWaktu;
            document.querySelector('#detailJenisJaminan').textContent = jenisJaminan;
            document.querySelector('#detailFotoJaminan').textContent = fotoJaminan;
            document.querySelector('#detailNilaiPasar').textContent = nilaiPasar;
            document.querySelector('#detailNilaiLikuiditas').textContent = nilaiLikuiditas;
            document.querySelector('#detailPutusanPinjaman').textContent = putusanPinjaman;
            document.querySelector('#detailBunga').textContent = bunga;
            document.querySelector('#detailBungaPerbulan').textContent = bungaPerbulan;
            document.querySelector('#detailPelunasan').textContent = pelunasan;
            document.querySelector('#detailBiayaAdministrasi').textContent = biayaAdministrasi;
            document.querySelector('#detailFotoJaminan').innerHTML = fotoJaminan;
        });

        function confirmSave() {
            return confirm("Apakah Anda yakin ingin menyimpan data ini?");
        }

        $(document).ready(function() {
            // Format rupiah untuk input Pengajuan Pinjaman
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

            $('#pengajuan_pinjaman').on('keyup', function() {
                this.value = formatRupiah(this.value, 'Rp ');
            });

            $('#confirmSubmit').on('click', function() {
                $('#transaksiModal form').submit();
            });

            $('#transaksiModal form').on('submit', function(event) {
                var pengajuanPinjaman = $('#pengajuan_pinjaman').val().replace(/[^0-9]/g, '');
                if (!pengajuanPinjaman) {
                    event.preventDefault();
                    alert("Pengajuan Pinjaman tidak boleh kosong.");
                }
            });
        });
        $(document).ready(function() {
        $('#jangka_waktu').on('input', function(e) {
            let cursorPos = this.selectionStart;
            let value = $(this).val().replace(/[^0-9]/g, '');
            
            if(value) {
                $(this).val(value + ' Bulan');
                this.setSelectionRange(cursorPos, cursorPos);
            }
        });
    });
    </script>
@endsection
