@extends('template')

@section('style')
    <style>
        .rp-input-container {
            position: relative;
            display: inline-block;
        }

        .rp-input-container input.rp-input-field {
            padding-left: 50px;
            font-size: 16px;
            width: 200px;
        }

        .rp-input-container .rp-input-prefix {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #666;
            pointer-events: none;
        }

        /* Custom indicator styles */
        .accordion-button::after {
            content: "+";
            font-size: 20px;
            color: #007bff;
            position: absolute;
            right: 20px;
        }

        .accordion-button.collapsed::after {
            content: "-";
        }
    </style>
@endsection

@section('page-heading')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> {{ $product->name }} - {{ $product->type_detail->name_id }} </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/staff/manage') }}">Product</a></li>
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
    </section>

    <section class="section">
        <div class="accordion" id="productAccordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne"> <!-- Change `aria-expanded` to `true` -->
                            Informasi Cluster : {{ $product->name }} - {{ $product->type_detail->name_id }}
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#productAccordion">
                    <!-- Add `show` class to make it open by default -->
                    <div class="card-body">
                        <p>{!! $product->description_en !!}</p>
                        <p>{!! $product->concept_en !!}</p>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Promos:</h5>
                                <ul>
                                    @foreach ($product->promos ?? [] as $promo)
                                        <li>{{ $promo->name_en ?? 'No name available' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Facilities:</h5>
                                <ul>
                                    @foreach ($product->facilities ?? [] as $facility)
                                        <li>{{ $facility->name_en ?? 'No name available' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Harga Produk</h5>
                    <form
                        action="{{ url('cms/manage-product/price/' . $product->parent_id . '/' . $product->child_id . '/update') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $product->child_id }}">
                        </input>
                        <div class="form-group">
                            <label for="pricePrefix">Prefix</label>
                            <input name="price_prefix" type="text" id="pricePrefix"
                                value="{{ $product->price->prefix ?? '' }}" class="form-control"
                                placeholder="Misal: Dimulai Dari" required>
                        </div>

                        <div class="form-group">
                            <label for="priceInput">Price (Rupiah):</label>
                            <input type="text" id="priceInput" class="form-control" placeholder="Masukkan harga" required
                                value="{{ $product->price->price ?? '' }}">
                            <input type="hidden" name="price" id="price-raw">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const priceInput = document.getElementById("priceInput");
                            const priceRaw = document.getElementById("price-raw");

                            function formatPrice(value) {
                                if (!value || isNaN(value)) return "";

                                // Split integer and decimal parts
                                let [integerPart] = value.split(".");

                                // Format with commas
                                let formattedValue = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                return formattedValue; // Hide decimal part
                            }

                            function getRawValue() {
                                return priceInput.value.replace(/,/g, "");
                            }

                            // On page load, format existing value
                            if (priceInput.value) {
                                priceRaw.value = getRawValue(); // Store raw value
                                priceInput.value = formatPrice(priceRaw.value);
                            }

                            document.querySelector('form').addEventListener('submit', function() {
                                priceRaw.value = getRawValue(); // Ensure correct raw value before submission
                            });

                            priceInput.addEventListener("blur", () => {
                                priceRaw.value = getRawValue(); // Save raw value
                                priceInput.value = formatPrice(priceRaw.value); // Display formatted value
                            });

                            priceInput.addEventListener("focus", () => {
                                if (priceRaw.value) {
                                    priceInput.value = priceRaw.value; // Restore full raw value for editing
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5>Fasilitas Unit</h5>
                    <form
                        action="{{ url('cms/manage-product/unit-facilities/' . $product->parent_id . '/' . $product->child_id . '/update') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $product->child_id }}">

                        <div class="form-group">
                            <div class="row">

                                @php
                                    $assignedFacilities = $product->unit_facilities
                                        ? $product->unit_facilities->pluck('id')->toArray()
                                        : [];
                                    $activeFacilities = $facilitiesTransaction
                                        ? collect($facilitiesTransaction)->pluck('fasilitas_id')->toArray()
                                        : [];
                                @endphp
                                @foreach ($facilities as $facility)
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                id="unit_facility_{{ $facility->id }}" name="unit_facilities[]"
                                                value="{{ $facility->id }}"
                                                {{ in_array($facility->id, $assignedFacilities) || in_array($facility->id, $activeFacilities) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="unit_facility_{{ $facility->id }}">
                                                <img src="{{ $facility->img_full_path }}" alt="{{ $facility->name }}"
                                                    width="20" height="20">
                                                {{ $facility->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12 mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="checkAllBtn">Check
                                        All</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                        id="uncheckAllBtn">Uncheck All</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Update Unit Facilities</button>
                    </form>
                </div>
            </div>


            <div class="card mt-3">
                <div class="card-body">
                    <h5>Gambar Unit</h5>

                    <!-- Image Upload Form -->
                    <form id="uploadImageForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="imageUpload">Pilih Gambar:</label>
                            <input type="file" class="form-control-file" id="imageUpload" name="images[]" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="imageType">Tipe Gambar:</label>
                            <select class="form-control" id="imageType" name="type" required>
                                <option value="exterior">Eksterior</option>
                                <option value="interior">Interior</option>
                                <option value="feature">Fitur</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="imageDescription">Deskripsi:</label>
                            <textarea class="form-control" id="imageDescription" name="description" rows="2" required></textarea>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3 d-none">
                            <label>Pratinjau:</label>
                            <img id="previewImg" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Upload Image</button>
                    </form>

                    <!-- Image Gallery -->
                    <div id="imageGallery" class="row mt-3">
                        <!-- Images will be dynamically inserted here -->
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const childId = "{{ $product->child_id }}"; // Now it's a string
                    const token = document.cookie.replace(/(?:(?:^|.*;\s*)killaToken\s*=\s*([^;]*).*$)|^.*$/, '$1');

                    // Fetch and display images
                    fetch(`/cms-user/product-images/${childId}/manage`, {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.meta.success) {
                                const gallery = document.getElementById('imageGallery');
                                data.result.forEach(image => {
                                    const imgWrapper = document.createElement('div');
                                    imgWrapper.className = 'col-md-3 mb-3 position-relative';
                                    imgWrapper.innerHTML = `
                                        <div class="position-relative">
                                            <img src="${image.full_image_path}" class="img-thumbnail img-fluid" alt="Image">
                                            <p class="text-muted small">${image.type} - ${image.description}</p>
                                            <button onclick="deleteImage(${image.id})" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1">
                                                &times;
                                            </button>
                                        </div>
                                    `;
                                    gallery.appendChild(imgWrapper);
                                });
                            } else {
                                alert('Failed to fetch images: ' + data.meta.message);
                            }
                        });

                    // Show image preview before upload
                    document.getElementById('imageUpload').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('previewImg').src = e.target.result;
                                document.getElementById('imagePreview').classList.remove('d-none');
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    // Handle image upload
                    document.getElementById('uploadImageForm').addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const imageInput = document.getElementById('imageUpload');
                        if (imageInput.files.length === 0) {
                            Swal.fire("Error", "Please select an image", "error");
                            return;
                        }

                        const formData = new FormData();
                        formData.append('images[]', imageInput.files[0]);
                        formData.append('type', document.getElementById('imageType').value);
                        formData.append('description', document.getElementById('imageDescription').value);

                        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');
                        let childId = "{{ $product->child_id }}"; // Replace with actual ID logic

                        Swal.fire({
                            title: "Are you sure?",
                            text: "Do you want to upload this image?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, upload!"
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                try {
                                    const response = await fetch(
                                        `/cms-user/product-images/${childId}/upload`, {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            body: formData
                                        });

                                    const data = await response.json();

                                    if (response.ok) {
                                        Swal.fire("Success", "Image uploaded successfully!",
                                            "success").then(() => {
                                            window.location.reload();
                                        });
                                    } else {
                                        Swal.fire("Error", data.message ||
                                            "Failed to upload image", "error");
                                    }
                                } catch (error) {
                                    Swal.fire("Error", "An error occurred: " + error.message,
                                        "error");
                                }
                            }
                        });
                    });
                });

                // Function to delete an image
                function deleteImage(imageId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            fetch(`/cms-user/product-images/${imageId}/delete`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Content-Type': 'application/json'
                                    },
                                    credentials: 'include'
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Image has been deleted.',
                                            'success'
                                        ).then(() => window.location.reload());
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            data.error || 'Failed to delete the image.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    Swal.fire(
                                        'Error!',
                                        'An error occurred: ' + error.message,
                                        'error'
                                    );
                                });
                        }
                    });
                }
            </script>

            <script>
                document.getElementById('checkAllBtn').addEventListener('click', function() {
                    document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
                        checkbox.checked = true;
                    });
                });

                document.getElementById('uncheckAllBtn').addEventListener('click', function() {
                    document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                });
            </script>


        </div>
    </section>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
