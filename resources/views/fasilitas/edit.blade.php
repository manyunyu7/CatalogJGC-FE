@extends('template')

@section('page-heading')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Fasilitas</h3>
                    <p class="text-subtitle text-muted">Gunakan formulir ini untuk memperbarui fasilitas</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Fasilitas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-content')
    <section class="section">
        @include('components.message')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Fasilitas</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="file" accept="image/*" class="form-control" id="icon" name="icon"
                                    onchange="previewImage(event)">
                                <div class="mt-2">
                                    @if ($fasilitas->icon)
                                        <img id="icon-preview" src="{{ env('URL_BE_ASSET') . $fasilitas->icon }}"
                                            alt="Icon" class="img-thumbnail" width="100">
                                    @else
                                        <img id="icon-preview" src="#" alt="Icon Preview" class="img-thumbnail"
                                            width="100" style="display:none;">
                                    @endif
                                </div>
                                @error('icon')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $fasilitas->name) }}" required>
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $fasilitas->description) }}</textarea>
                        @error('description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>

                <script>
                    function previewImage(event) {
                        const file = event.target.files[0];
                        const reader = new FileReader();
                        const preview = document.getElementById('icon-preview');

                        // Check if a file is selected
                        if (file) {
                            reader.onload = function() {
                                preview.src = reader.result;
                                preview.style.display = 'block'; // Show preview
                            };
                            reader.readAsDataURL(file); // Load the image data
                        } else {
                            preview.style.display = 'none'; // Hide preview if no file
                        }
                    }
                </script>
            </div>
        </div>
    </section>
@endsection
