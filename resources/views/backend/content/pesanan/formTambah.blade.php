@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Tambah Pesanan</h1>
        <form action="{{ route('pesanan.prosesTambah') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                @error('nama_pelanggan')
                <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Produk</label>
                <div>
                    @foreach ($products as $product)
                        <div class="form-check">
                            <input class="form-check-input product-checkbox" type="checkbox" value="{{ $product->id }}" id="product_{{ $product->id }}" name="products[]">
                            <label class="form-check-label" for="product_{{ $product->id }}">
                                {{ $product->name }}
                                <input type="number" class="form-control jumlah_produk" id="jumlah_{{ $product->id }}" name="jumlah[]" min="1" value="1">
                                <input type="hidden" class="harga_produk" value="{{ $product->price }}">
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga</label>
                <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.product-checkbox').change(function() {
                calculateTotal();
            });

            $('.jumlah_produk').on('input', function() {
                calculateTotal();
            });

            function calculateTotal() {
                var total = 0;
                $('.product-checkbox:checked').each(function() {
                    var productId = $(this).val();
                    var jumlah = parseInt($('#jumlah_' + productId).val());
                    var harga = parseFloat($('#jumlah_' + productId).siblings('.harga_produk').val());
                    total += jumlah * harga;
                });
                $('#total_harga').val(total.toFixed(2));
            }
        });
    </script>
@endpush
