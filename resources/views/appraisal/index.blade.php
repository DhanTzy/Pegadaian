@extends('layouts.app')

@section('contents')
    <div class="content">
        <div>
            <main class="app-main">
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="fw-bold fs-3">Data Appraisal</h1>
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
                                <table id="appraisalTable" class="table table-striped table-bordered">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Jaminan</th>
                                            <th>Nilai Pasar</th>
                                            <th>Nilai Likuiditas</th>
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
    <div class="modal fade" id="appraisalDetailModal" tabindex="-1" aria-labelledby="appraisalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="appraisalForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="appraisalModalLabel">Appraisal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jenis_jaminan" class="form-label">Jenis Jaminan</label>
                            <input type="text" class="form-control" id="jenis_jaminan" name="jenis_jaminan" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="foto_jaminan" class="form-label">Upload Foto</label>
                            <input type="file" class="form-control" id="foto_jaminan" name="foto_jaminan[]" multiple
                                accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Jaminan</label>
                            <div id="fotoPreviewContainer" class="d-flex flex-wrap" style="display: none;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nilai_pasar" class="form-label">Nilai Pasar</label>
                            <input type="text" class="form-control" id="nilai_pasar" name="nilai_pasar">
                        </div>

                        <div class="mb-3">
                            <label for="nilai_likuiditas" class="form-label">Nilai Likuiditas</label>
                            <input type="text" class="form-control" id="nilai_likuiditas" name="nilai_likuiditas">
                        </div>

                        {{-- <div class="mb-3">
                            <label for="status_transaksi" class="form-label">Status</label>
                            <select class="form-select" id="status_transaksi" name="status_transaksi" disabled>
                                <option value="menunggu appraisal">Menunggu Appraisal</option>
                                <option value="menunggu approval">Menunggu Approval</option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #183354;"><i class="bi bi-send"></i> Simpan</button>
                    </div>
                </div>
            </form>
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
            const fullString = `${dayString}, ${dateString} . ${timeString}`;

            document.getElementById('current-info').innerText = fullString;
        }
        setInterval(updateTime, 1000);
        updateTime();

        $(document).ready(function() {
            let table = $('#appraisalTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('appraisal.data') }}",
                columns: [{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'jenis_jaminan', name: 'jenis_jaminan' },
                    { data: 'nilai_pasar', name: 'nilai_pasar' },
                    { data: 'nilai_likuiditas', name: 'nilai_likuiditas' },
                    { data: 'status_transaksi', name: 'status_transaksi' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#appraisalDetailModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                modal.find('#jenis_jaminan').val(button.data('jenis_jaminan'));
                modal.find('#nilai_pasar').val(button.data('nilai_pasar'));
                modal.find('#nilai_likuiditas').val(button.data('nilai_likuiditas'));
                modal.find('#foto_jaminan_existing').html(button.data('foto_jaminan'));

                let url = "{{ route('appraisal.update', ':id') }}";
                $('#appraisalForm').attr('action', url.replace(':id', button.data('id')));
            });

            // Konfirmasi sebelum submit form
            $('#appraisalForm').on('submit', function(e) {
                e.preventDefault();

                let statusTransaksi = $('#status_transaksi').val();

                if (statusTransaksi === 'menunggu approval') {
                    alert('Transaksi akan masuk ke tahap Menunggu Approval.');
                }

                if (confirm("Apakah Anda yakin ingin menyimpan perubahan?")) {
                    this.submit();
                }
            });
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

        $(document).on('input', '#nilai_pasar, #nilai_likuiditas', function() {
            this.value = formatRupiah(this.value);
        });

        $('#nilai_pasar').on('input', function() {
            let nilaiPasar = $(this).val().replace(/[^0-9]/g, '');
            if (nilaiPasar) {
                let nilaiLikuiditas = (parseFloat(nilaiPasar) * 0.7).toFixed(0);
                $('#nilai_likuiditas').val(formatRupiah(nilaiLikuiditas));
            }
        });

        $('#foto_jaminan').on('change', function(event) {
            let files = event.target.files;
            let previewContainer = $('#fotoPreviewContainer');

            // Hapus preview lama
            previewContainer.html('');

            if (files && files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    let reader = new FileReader();
                    let file = files[i];

                    reader.onload = function(e) {
                        let img = $('<img/>', {
                            src: e.target.result,
                            class: 'img-fluid',
                            style: 'max-width: 150px; max-height: 150px; object-fit: cover; margin-right: 10px; margin-bottom: 10px;',
                            alt: 'Preview Foto Jaminan'
                        });

                        previewContainer.append(img);
                    };

                    reader.readAsDataURL(file);
                }

                previewContainer.show();
            } else {
                previewContainer.hide();
            }
        });
    </script>
@endsection
