@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('contents')
    <main class="content">
        <div class="container">
          <div class="row" style="display: flex;">
            <div class="col border" style="flex: 1;">
              Data Gadai Tahunan
              <img src="/img/grafik.png" alt="Grafik" class="img-fluid" style="width: 100%;">
            </div>
            <div class="col" style="flex: 1; display: flex; flex-direction: column;">
              <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                <div class="card-dashboard border mb-5">
                  <h1 class="text-center">Jumlah Nasabah 30</h1>
                </div>
                <div class="card-dashboard border">
                  <h1 class="text-center">Barang Nasabah 30</h1>
                </div>
              </div>
            </div>
          </div>

          <div class="table">
            <table id="myTable" class="table table-striped table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Nasabah</th>
                        <th scope="col">Barang Yang Digadaikan</th>
                        <th scope="col">Jumlah Pinjam</th>
                        <th scope="col">Bunga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rayhan Riyadhul Jinan</td>
                        <td>Surat Rumah</td>
                        <td>500.000.000</td>
                        <td>Rp. 500.000.000</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
    </main>
@endsection

@push('style')
    <link rel="{{ asset('css/admin/admin.css') }}">
@endpush

@push('script')
      <script src="{{ asset('js/rehan.js') }}"></script>
@endpush
