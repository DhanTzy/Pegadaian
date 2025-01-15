@extends('admin.layouts.app')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main"> <!--begin::App Content Header-->
                <div class="app-content-header"> <!--begin::Container-->
                    <div class="container-fluid"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Data Approval</h1>
                            </div>
                        </div> <!--end::Row-->
                    </div> <!--end::Container-->
                </div> <!--end::App Content Header--> <!--begin::App Content-->
                <div class="app-content">
                    <div class="card mb-4">
                        <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                            <p id="current-info" style="margin: 0; font-size: 16px;"></p>
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
                                            <th>Nilai Pasar</th>
                                            <th>Nilai Likuiditas</th>
                                            <th>Jangka Waktu</th>
                                            <th>Bunga</th>
                                            <th>Bunga Perbulan</th>
                                            <th>Pelunasan</th>
                                            <th>Biaya Administrasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                        <div class="mb-3">
                            <label for="jenis_jaminan" class="form-label">Jenis Jaminan</label>
                            <input type="text" class="form-control" id="jenis_jaminan" name="jenis_jaminan" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nilai_pasar" class="form-label">Nilai Pasar</label>
                            <input type="text" class="form-control" id="nilai_pasar" name="nilai_pasar" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nilai_likuiditas" class="form-label">Nilai Likuiditas</label>
                            <input type="text" class="form-control" id="nilai_likuiditas" name="nilai_likuiditas"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label for="putusan_pinjaman" class="form-label">Putusan Pinjaman</label>
                            <input type="text" class="form-control" id="putusan_pinjaman" name="putusan_pinjaman">
                        </div>

                        <div class="mb-3">
                            <label for="bunga" class="form-label">Bunga</label>
                            <input type="text" class="form-control" id="bunga" name="bunga">
                        </div>

                        <div class="mb-3">
                            <label for="bunga_perbulan" class="form-label">Bunga Perbulan</label>
                            <input type="text" class="form-control" id="bunga_perbulan" name="bunga_perbulan">
                        </div>

                        <div class="mb-3">
                            <label for="pelunasan" class="form-label">Pelunasan</label>
                            <input type="text" class="form-control" id="pelunasan" name="pelunasan">
                        </div>

                        <div class="mb-3">
                            <label for="biaya_administrasi" class="form-label">Biaya Administrasi</label>
                            <input type="text" class="form-control" id="biaya_administrasi" name="biaya_administrasi"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label for="status_transaksi" class="form-label">Status</label>
                            <select class="form-select" id="status_transaksi" name="status_transaksi" disabled>
                                <option value="menunggu approval">Menunggu Approval</option>
                                <option value="approval selesai">Approval Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
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
            const fullString = `${dayString}, ${dateString}, ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();

        $(document).ready(function() {
            let table = $('#approvalTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.approval.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jenis_jaminan',
                        name: 'jenis_jaminan'
                    },
                    {
                        data: 'nilai_pasar',
                        name: 'nilai_pasar'
                    },
                    {
                        data: 'nilai_likuiditas',
                        name: 'nilai_likuiditas'
                    },
                    {
                        data: 'jangka_waktu',
                        name: 'jangka_waktu'
                    },
                    {
                        data: 'bunga',
                        name: 'bunga'
                    },
                    {
                        data: 'bunga_perbulan',
                        name: 'bunga_perbulan'
                    },
                    {
                        data: 'pelunasan',
                        name: 'pelunasan'
                    },
                    {
                        data: 'biaya_administrasi',
                        name: 'biaya_administrasi'
                    },
                    {
                        data: 'status_transaksi',
                        name: 'status_transaksi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#approvalModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                modal.find('#biaya_administrasi').val(formatRupiah('20000'));
                modal.find('#putusan_pinjaman').val('');
                modal.find('#bunga').val('');
                modal.find('#bunga_perbulan').val('');
                modal.find('#pelunasan').val('');

                let jenisJaminan = button.data('jenis_jaminan');
                let nilaiPasar = button.data('nilai_pasar');
                let nilaiLikuiditas = button.data('nilai_likuiditas');

                if (jenisJaminan) modal.find('#jenis_jaminan').val(jenisJaminan);
                if (nilaiPasar) modal.find('#nilai_pasar').val(nilaiPasar);
                if (nilaiLikuiditas) modal.find('#nilai_likuiditas').val(nilaiLikuiditas);
                modal.find('#approvalForm').attr('action', "{{ url('admin/approval') }}/" + button.data(
                    'id'));
            });
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
            '#nilai_pasar, #nilai_likuiditas, #putusan_pinjaman, #bunga_perbulan, #pelunasan, #biaya_administrasi',
            function() {
                this.value = formatRupiah(this.value);
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

        $(document).on('input', '#bunga', function() {
            let value = $(this).val().replace('%', '');
            $(this).val(value + '%');
        });

        $(document).on('input', '#nilai_pasar, #nilai_likuiditas, #bunga_perbulan, #pelunasan, #biaya_administrasi',
            function() {
                this.value = formatRupiah(this.value);
            });
    </script>
@endsection
