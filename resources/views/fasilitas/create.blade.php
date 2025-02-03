@extends('template')

@section('page-heading')
    <h3>Tambah Fasilitas</h3>
@endsection

@section('page-content')
    <section class="section">
        @include('components.message')

        <div class="card">
            <div class="card-body">
                <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="file" class="form-control" accept="image/*" id="icon" name="icon"
                            accept="image/*" required onchange="previewImage(event)">
                        <img class="img-fluid" id="icon-preview" src="#" alt="Pratinjau Icon"
                            style="display: none; margin-top: 10px; max-width: 100px;">
                        @error('icon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                <script>
                    document.getElementById('fasilitasForm').addEventListener('submit', async function(event) {
                        event.preventDefault(); // Prevent default form submission

                        // Retrieve token from cookies
                        const token = document.cookie.split('; ').find(row => row.startsWith('killaToken='))
                            ?.split('=')[1];

                        if (!token) {
                            alert("User is not authenticated.");
                            return;
                        }

                        // Prepare FormData
                        const formData = new FormData(this);

                        try {
                            const response = await fetch("{{ route('fasilitas.store') }}", {
                                method: "POST",
                                headers: {
                                    "Authorization": `Bearer ${token}`
                                },
                                body: formData
                            });

                            const result = await response.json();

                            if (!response.ok) {
                                throw new Error(result.message || "Something went wrong");
                            }

                            alert("Data berhasil disimpan!");
                            window.location.reload();
                        } catch (error) {
                            console.error("Error:", error);
                            alert("Terjadi kesalahan: " + error.message);
                        }
                    });
                </script>
            </div>
        </div>
    </section>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('icon-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
