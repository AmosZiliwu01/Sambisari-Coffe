@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Page</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('page.prosesTambah')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="col-form-label">Judul Page</label>
                        <input type="text" name="judul_page" value="{{old('judul_page')}}" class="form-control @error('judul_page') is-invalid @enderror">
                        @error('judul_page')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Isi Page</label>
                        <textarea id="editor" name="isi_page" class="form-control @error('isi_page') is-invalid @enderror">{{old('isi_page')}}</textarea>
                        @error('isi_page')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{route('page.index')}}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                simpleUpload: {

                    // Enable the `withCredentials` flag for CORS requests.
                    withCredentials: true,

                    // Headers sent along with the XMLHttpRequest to the upload server.
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
