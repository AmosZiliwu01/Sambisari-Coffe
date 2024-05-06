@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Feedback</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('feedback.prosesTambah') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <input type="text" name="content" value="{{ old('content') }}" class="form-control @error('content') is-invalid @enderror">
                        @error('content')
                        <span style="color: red; font-weight: 600; font-size: 9pt;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Rating</label>
                        <div class="rating">
                            <input type="hidden" name="rating" id="rating" value="0">
                            <span class="star" data-star="5">&#9733;</span>
                            <span class="star" data-star="4">&#9733;</span>
                            <span class="star" data-star="3">&#9733;</span>
                            <span class="star" data-star="2">&#9733;</span>
                            <span class="star" data-star="1">&#9733;</span>
                        </div>
                        @error('rating')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <style>
                        .rating {
                            unicode-bidi: bidi-override;
                            direction: rtl;
                        }

                        .rating span {
                            cursor: pointer;
                            display: inline-block;
                            position: relative;
                            font-size: 30px;
                            color: gray;
                        }

                        .rating span:hover:before,
                        .rating span:focus:before {
                            content: "\2605";
                            position: absolute;
                            color: gold;
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const stars = document.querySelectorAll('.star');

                            stars.forEach(function (star) {
                                star.addEventListener('click', function () {
                                    const rating = this.dataset.star;

                                    for (let i = 0; i < stars.length; i++) {
                                        if (stars[i].dataset.star <= rating) {
                                            stars[i].style.color = 'gold';
                                        } else {
                                            stars[i].style.color = 'gray';
                                        }
                                    }

                                    document.getElementById('rating').value = rating;
                                });
                            });
                        });
                    </script>


                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
