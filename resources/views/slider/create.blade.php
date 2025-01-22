<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add New Slider</h4>
    </div>

    <div class="card-body">
        <form action="{{ url('company-profile/slider/store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="basicInput">Judul Utama</label>
                        <input type="text" name="title" required class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" id="basicInput" placeholder="Title">
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="basicInput">Deskripsi</label>
                        <textarea style="height: 200px" name="description" class="form-control @error('description') is-invalid @enderror" id="basicInput" placeholder="Deskripsi">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <small class="text-muted">Please provide a detailed description (minimum 2 lines).</small>
                    </div>

                    {{-- <!-- Action -->
                    <div class="form-group">
                        <label for="basicInput">Action</label>
                        <input type="text" name="action" class="form-control @error('action') is-invalid @enderror"
                               value="{{ old('action') }}" placeholder="Action">
                        @error('action')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}

                    {{-- <!-- Action Link -->
                    <div class="form-group">
                        <label for="basicInput">Link</label>
                        <input type="text" name="action_link" class="form-control @error('action_link') is-invalid @enderror"
                               value="{{ old('action_link') }}" placeholder="Action Link">
                        @error('action_link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}

                    {{-- <!-- Second Action -->
                    <div class="form-group">
                        <label for="basicInput">Action 2</label>
                        <input type="text" name="second_action" class="form-control @error('second_action') is-invalid @enderror"
                               value="{{ old('second_action') }}" placeholder="Action">
                        @error('second_action')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Second Action Link -->
                    <div class="form-group">
                        <label for="basicInput">Link 2</label>
                        <input type="text" name="second_action_link" class="form-control @error('second_action_link') is-invalid @enderror"
                               value="{{ old('second_action_link') }}" placeholder="Action Link">
                        @error('second_action_link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}

                    <!-- Order -->
                    <div class="form-group">
                        <label for="basicInput">Urutan</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                               value="{{ old('order') }}" placeholder="Urutan">
                        @error('order')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Background Image -->
                    <div class="form-group">
                        <label for="formFile" class="form-label">Background</label>
                        <input name="image" class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" accept="image/*">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <img src="{{asset("bsb/thumbnail_upload.jpg")}}" style="border-radius: 20px; max-width: 500px" id="imgPreview" class="img-fluid" alt="Responsive image">

                    {{-- <!-- Icon -->
                    <div class="form-group">
                        <label for="formIcon" class="form-label">Icon</label>
                        <input name="icon" class="form-control @error('icon') is-invalid @enderror" type="file" id="formIcon" accept="image/*">
                        @error('icon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                    {{-- <img src="{{asset("bsb/thumbnail_upload.jpg")}}" style="border-radius: 20px; max-width: 300px" id="iconPreview" class="img-fluid img-thumbnail" alt="Responsive image"> --}}
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add Data</button>
                </div>
            </div>
        </form>
    </div>
</div>


@push('script')
    <script>
        var el = document.getElementById('formFile');
        el.onchange = function() {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formFile").files[0])
            fileReader.onload = function(oFREvent) {
                document.getElementById("imgPreview").src = oFREvent.target.result;
            };
        }

        var ul = document.getElementById('formIcon');
        ul.onchange = function() {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formIcon").files[0])
            fileReader.onload = function(oFREvent) {
                document.getElementById("iconPreview").src = oFREvent.target.result;
            };
        }


        $(document).ready(function() {
            $.myfunction = function() {
                $("#previewName").text($("#inputTitle").val());
                var title = $.trim($("#inputTitle").val())
                if (title == "") {
                    $("#previewName").text("Judul")
                }
            };

            $("#inputTitle").keyup(function() {
                $.myfunction();
            });

        });
    </script>
@endpush
