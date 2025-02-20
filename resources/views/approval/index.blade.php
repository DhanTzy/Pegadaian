@extends('layouts.app')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Data Approval</h1>
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
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="approvalTable" class="table table-striped table-bordered">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Jaminan</th>
                                            <th>Nilai Pasar APS</th>
                                            <th>Nilai Likuiditas APS</th>
                                            <th>Jangka Waktu</th>
                                            <th>Bunga</th>
                                            <th>Bunga Perbulan</th>
                                            <th>Pelunasan</th>
                                            <th>Biaya Administrasi</th>
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

    <!-- Modal -->
    <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="approvalForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approvalModalLabel">Approval</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenis_jaminan" class="form-label">Jenis Jaminan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="jenis_jaminan" name="jenis_jaminan" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nilai_pasar_aps" class="form-label">Nilai Pasar APS <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nilai_pasar_aps" name="nilai_pasar_aps" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nilai_likuiditas_aps" class="form-label">Nilai Likuiditas APS <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nilai_likuiditas_aps" name="nilai_likuiditas_aps" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nilai_pasar_apv" class="form-label">Nilai Pasar APV <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nilai_pasar_apv" name="nilai_pasar_apv">
                                </div>

                                <div class="mb-3">
                                    <label for="nilai_likuiditas_apv" class="form-label">Nilai Likuiditas APV <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nilai_likuiditas_apv" name="nilai_likuiditas_apv">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Jaminan <span class="text-danger">*</span></label>
                                    <div id="modalFotoJaminan" class="d-flex gap-2"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="putusan_pinjaman" class="form-label">Putusan Pinjaman <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="putusan_pinjaman" name="putusan_pinjaman">
                                </div>

                                <div class="mb-3">
                                    <label for="bunga" class="form-label">Bunga <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="bunga" name="bunga">
                                </div>

                                <div class="mb-3">
                                    <label for="bunga_perbulan" class="form-label">Bunga Perbulan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="bunga_perbulan" name="bunga_perbulan" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="pelunasan" class="form-label">Pelunasan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pelunasan" name="pelunasan" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="biaya_administrasi" class="form-label">Biaya Administrasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="biaya_administrasi" name="biaya_administrasi" readonly>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #183354;" id="saveButton"><i class="bi bi-send"></i> Simpan</button>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="status_transaksi" class="form-label">Status</label>
                                    <select class="form-select" id="status_transaksi" name="status_transaksi" disabled>
                                        <option value="menunggu approval">Menunggu Approval</option>
                                        <option value="approval selesai">Approval Selesai</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
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
            const fullString = `${dayString}, ${dateString} . ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();

        $(document).ready(function() {
            let table = $('#approvalTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('approval.data') }}",
                columns: [{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'jenis_jaminan', name: 'jenis_jaminan' },
                    { data: 'nilai_pasar_aps', name: 'nilai_pasar_aps' },
                    { data: 'nilai_likuiditas_aps', name: 'nilai_likuiditas_aps' },
                    { data: 'jangka_waktu', name: 'jangka_waktu' },
                    { data: 'bunga', name: 'bunga' },
                    { data: 'bunga_perbulan', name: 'bunga_perbulan' },
                    { data: 'pelunasan', name: 'pelunasan' },
                    { data: 'biaya_administrasi', name: 'biaya_administrasi' },
                    { data: 'status_transaksi', name: 'status_transaksi' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#approvalModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                modal.find('#biaya_administrasi').val('');
                modal.find('#putusan_pinjaman').val('');
                modal.find('#bunga').val('');
                modal.find('#bunga_perbulan').val('');
                modal.find('#pelunasan').val('');

                let jenisJaminan = button.data('jenis_jaminan');
                let fotoJaminan = button.data('foto_jaminan')
                let nilaiPasar = button.data('nilai_pasar_aps');
                let nilaiLikuiditas = button.data('nilai_likuiditas_aps');

                if (jenisJaminan) modal.find('#jenis_jaminan').val(jenisJaminan);
                if (fotoJaminan) {
                    modal.find('#modalFotoJaminan').html(fotoJaminan);
                }
                if (nilaiPasar) modal.find('#nilai_pasar_aps').val(nilaiPasar);
                if (nilaiLikuiditas) modal.find('#nilai_likuiditas_aps').val(nilaiLikuiditas);
                modal.find('#approvalForm').attr('action', "{{ url('approval') }}/" + button.data(
                    'id'));
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            const putusanPinjamanInput = document.getElementById("putusan_pinjaman");
            const biayaAdministrasiInput = document.getElementById("biaya_administrasi");

            function formatRupiah(angka) {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                }).format(angka);
            }

            function hitungBiayaAdministrasi() {
                let putusanPinjaman = putusanPinjamanInput.value.replace(/\D/g, "");
                putusanPinjaman = parseFloat(putusanPinjaman) || 0;

                let biayaAdministrasi = 0;

                if (putusanPinjaman > 0) {
                    if (putusanPinjaman <= 20000000) {
                        biayaAdministrasi = putusanPinjaman * 0.025; // 2,5%
                    } else {
                        biayaAdministrasi = putusanPinjaman * 0.01; // 1%
                    }
                }
                biayaAdministrasiInput.value = formatRupiah(biayaAdministrasi);
            }
            putusanPinjamanInput.addEventListener("input", hitungBiayaAdministrasi);
        });

        $('#saveButton').on('click', function(event) {
            event.preventDefault();
            let isValid = true;
            let modal = $('#approvalModal');
            modal.find('input').each(function() {
                if (!$(this).val() && $(this).attr('id') !== 'biaya_administrasi') {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (isValid) {
                if (confirm('Apakah Anda yakin ingin menyimpan perubahan ini?')) {
                    $('#approvalForm').submit();
                }
            } else {
                alert('Harap isi semua field yang diperlukan.');
            }
        });

        function formatRupiah(value, prefix = 'Rp ') {
            let numberString = value.replace(/[^,\d]/g, '').toString();
            let split = numberString.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }

        $(document).on('input',
            '#nilai_pasar_apv, #nilai_likuiditas_apv, #putusan_pinjaman, #bunga_perbulan, #pelunasan, #biaya_administrasi',
            function() {
                this.value = formatRupiah(this.value);
            });
        $('#nilai_pasar_apv').on('input', function() {
            let nilaiPasar = $(this).val().replace(/[^0-9]/g, '');
            if (nilaiPasar) {
                let nilaiLikuiditas = (parseFloat(nilaiPasar) * 0.7).toFixed(0);
                $('#nilai_likuiditas_apv').val(formatRupiah(nilaiLikuiditas));
            }
        });

        function calculateValues() {
            let putusanPinjaman = parseFloat($('#putusan_pinjaman').val().replace(/[^,\d]/g, '').replace(',', '.')) || 0;
            let bungaPercent = parseFloat($('#bunga').val().replace('%', '')) || 0;

            let bungaPerbulan = putusanPinjaman * (bungaPercent / 100);
            let pelunasan = putusanPinjaman + bungaPerbulan;

            $('#bunga_perbulan').val(formatRupiah(bungaPerbulan.toFixed(0).toString()));
            $('#pelunasan').val(formatRupiah(pelunasan.toFixed(0).toString()));
        }

        $(document).on('input', '#putusan_pinjaman, #bunga', function() {
            calculateValues();
        });

        $(document).ready(function() {
            $('#bunga').on('input', function(e) {
                let cursorPos = this.selectionStart;
                let value = $(this).val().replace(/[^0-9]/g, '');
                if(value) {
                    $(this).val(value + '%');
                    this.setSelectionRange(cursorPos, cursorPos);
                }
            });
        });

        // $(document).on('input', '#nilai_pasar, #nilai_likuiditas, #bunga_perbulan, #pelunasan, #biaya_administrasi',
        //     function() {
        //         this.value = formatRupiah(this.value);
        //     });
    </script>
@endsection
