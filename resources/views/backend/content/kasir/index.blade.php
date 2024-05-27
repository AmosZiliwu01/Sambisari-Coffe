@extends('backend.layout.main')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">App Kasir</h1>
            </div>

            <div class="col-12">
                <input type="text" id="input-barcode" name="barcode" class="form-control" placeholder="Scan Barcode"/>
            </div>
        </div>
    </div>
    <form method="post" action="{{url('/app/insert')}}">
        @csrf
        <div class="row">
            <div class="col-lg-8 col-md-12 mt-3 pl-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customer-name">Nama Pelanggan</label>
                            <input type="text" id="customer-name" name="customer_name" class="form-control" placeholder="Nama Pelanggan" required>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="table-cart">
                                <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Nama Produk</th>
                                    <th>@</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6 text-left mb-2">
                        <a href="{{url('/transaksi')}}" class="btn btn-secondary">Lihat Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-3 pr-md-4">
                <div class="card">
                    <div class="card-body">
                        <table width="100%" id="total-section">
                            <tr>
                                <td class="h3 text-center">Total Belanja</td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="subtotal">Subtotal</label>
                                    <input type="text" readonly name="subtotal" id="subtotal" class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="discount">Discount (%)</label>
                                    <input type="number" min="0" max="100" name="discount" id="discount" value="0" class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="total">Total</label>
                                    <input type="text" readonly name="total" id="total" class="form-control text-right">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </div>
            <!-- Tabel untuk menampilkan daftar produk -->

            <div class="col-lg-12 col-md-12 mt-3 m-2">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" collspacing="0">
                            <div class="h3 text-left">List Product</div>
                            <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->barcode }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- List Pesanan --}}
        <div class="col-lg-12 col-md-12 mt-3 m-2">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div class="h3 text-left">List Pesanan</div>
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pesanan->nama_pelanggan }}</td>
                                <td>{{ $pesanan->total_harga }}</td>
                                <td>{{ $pesanan->status }}</td>
                                <td>
                                    <a href="{{route('pesanan.detail',$pesanan->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    @if($pesanan->status == 'Proses')
                                        <a href="{{ route('pesanan.updateStatus', ['id' => $pesanan->id, 'status' => 'Selesai']) }}" class="btn btn-sm btn-success">
                                            Selesai
                                        </a>
                                    @else
                                        <a href="{{ route('pesanan.updateStatus', ['id' => $pesanan->id, 'status' => 'Proses']) }}" class="btn btn-sm btn-warning">
                                            Proses
                                        </a>
                                    @endif
                                    <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this pesanan?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('js')
    <script>
        $(function () {
            // Event untuk input barcode
            $('#input-barcode').on('keypress', function (e) {
                if (e.which === 13) {
                    console.log('Enter di klik');
                    //pencarian data via ajax
                    $.ajax({
                        url: '/app/search-barcode',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            barcode: $(this).val()
                        },
                        success: function (data) {
                            addProductToTable(data);
                            toastr.success('Barang Berhasil masuk ke keranjang belanja', 'Berhasil');
                            $('#input-barcode').val('');
                        },
                        error: function () {
                            toastr.error('Barang yang dicari tidak ditemukan', 'Error');
                            $('#input-barcode').val('');
                        }
                    })
                }
            });

            // Fungsi untuk menambahkan produk ke tabel
            function addProductToTable(product) {
                let rowExist = $('#table-cart tbody').find('#p-' + product.barcode);
                if (rowExist.length > 0) {
                    //barcode sudah ada
                    let qty = parseInt(rowExist.find('.qty').eq(0).val());
                    qty += 1;
                    rowExist.find('.qty').eq(0).val(qty);
                    rowExist.find('td').eq(3).text(qty);
                    rowExist.find('td').eq(4).text((qty * product.price));
                } else {
                    let row = '';
                    row += `<tr id='p-${product.barcode}'>`;
                    row += `<td>${product.barcode}</td>`;
                    row += `<td>${product.name}</td>`;
                    row += `<td>${product.price}</td>`;
                    row += `<input type='hidden' name='price[]' class='price' value="${product.price}" />`;
                    row += `<input type='hidden' name='qty[]' class='qty' value="1" />`;
                    row += `<input type='hidden' name='id[]' value="${product.id}" />`;
                    row += `<td>1</td>`;
                    row += `<td>${product.price}</td>`;
                    row += `</tr>`;
                    $('#table-cart tbody').append(row);
                }
                hitungTotalBelanja();
            }

            // Fungsi untuk menghitung total belanja
            function hitungTotalBelanja() {
                let subtotal = 0;
                $('#table-cart tbody tr').each(function() {
                    let price = parseFloat($(this).find('.price').val());
                    let qty = parseInt($(this).find('.qty').val());
                    subtotal += price * qty;
                });
                let discount = parseInt($('#discount').val());
                let total = subtotal - (subtotal * discount / 100);
                $('#subtotal').val(subtotal);
                $('#total').val(total);
            }


            // Event untuk menghitung ulang total belanja ketika diskon diubah
            $('#discount').on('change', function () {
                hitungTotalBelanja();
            });

            // Event untuk submit form
            $('form').on('submit', function (e) {
                if ($('#table-cart tbody tr').length === 0) {
                    e.preventDefault();
                    toastr.error('Keranjang belanja kosong. Silakan tambahkan produk terlebih dahulu.', 'Error');
                }
            });
        });

    </script>
@endpush
