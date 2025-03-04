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
                <div class="card-header">
                    <h5>Facilities and Product Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manage-product-details.storeOrUpdate', $product->child_id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="POST">

                        <div class="row">
                            <!-- Floor Input with Icon -->
                            <div class="col-lg-6 mb-3">
                                <label for="floor" class="form-label">Lantai</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control @error('floor') is-invalid @enderror"
                                        id="floor" name="floor" placeholder="Masukan jumlah lantai/tingkat"
                                        value="{{ old('floor', $productInformationDetail->floor ?? '') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-house-door"></i>
                                    </div>
                                </div>
                                @error('floor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Electricity Input with Icon -->
                            <div class="col-lg-6 mb-3">
                                <label for="electricity" class="form-label">Daya Listrik</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control @error('electricity') is-invalid @enderror"
                                        id="electricity" name="electricity" placeholder="Masukkan Jumlah Watt"
                                        value="{{ old('electricity', $productInformationDetail->electricity ?? '') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-lightbulb"></i>
                                    </div>
                                </div>
                                @error('electricity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Panjang Tanah Input with Icon -->
                            <div class="col-lg-6 mb-3">
                                <label for="land_length" class="form-label">Panjang Tanah</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control @error('land_length') is-invalid @enderror"
                                        id="land_length" name="land_length" placeholder="Masukkan panjang tanah"
                                        value="{{ old('land_length', $productInformationDetail->land_length ?? '') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-rulers"></i>
                                    </div>
                                </div>
                                @error('land_length')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lebar Tanah Input with Icon -->
                            <div class="col-lg-6 mb-3">
                                <label for="land_width" class="form-label">Lebar Tanah</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control @error('land_width') is-invalid @enderror"
                                        id="land_width" name="land_width" placeholder="Masukkan lebar tanah"
                                        value="{{ old('land_width', $productInformationDetail->land_width ?? '') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-rulers"></i>
                                    </div>
                                </div>
                                @error('land_width')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Panjang Bangunan Input with Icon -->
                            <div class="col-lg-6 mb-3">
                                <label for="building_length" class="form-label">Panjang Bangunan</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text"
                                        class="form-control @error('building_length') is-invalid @enderror"
                                        id="building_length" name="building_length"
                                        placeholder="Masukkan panjang bangunan"
                                        value="{{ old('building_length', $productInformationDetail->building_length ?? '') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-rulers"></i>
                                    </div>
                                </div>
                                @error('building_length')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lebar Bangunan Input with Icon -->
                            <div class="col-lg-6 mb-3">
                                <label for="building_width" class="form-label">Lebar Bangunan</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text"
                                        class="form-control @error('building_width') is-invalid @enderror"
                                        id="building_width" name="building_width" placeholder="Masukkan lebar bangunan"
                                        value="{{ old('building_width', $productInformationDetail->building_width ?? '') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-rulers"></i>
                                    </div>
                                </div>
                                @error('building_width')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <!-- Land Area -->
                            <div class="col-lg-6 mb-3">
                                <label for="luas_tanah" class="form-label">Land Area (m²)</label>
                                <p class="text-muted">The total area of the land where the property is located.</p>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" id="luas_tanah" name="luas_tanah"
                                        placeholder="Land Area" value="{{ $product->type_detail->luas_tanah }}" readonly>
                                    <div class="form-control-icon">
                                        <i class="bi bi-pin-map"></i>
                                    </div>
                                </div>
                            </div>



                            <!-- Building Area -->
                            <div class="col-lg-6 mb-3">
                                <label for="luas_bangunan" class="form-label">Building Area (m²)</label>
                                <p class="text-muted">The total area occupied by the building, including all floors.</p>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" id="luas_bangunan" name="luas_bangunan"
                                        placeholder="Building Area" value="{{ $product->type_detail->luas_bangunan }}"
                                        readonly>
                                    <div class="form-control-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Room & Bonus -->
                            <div class="col-lg-6 mb-3">
                                <label for="additional_room" class="form-label">Additional Rooms</label>
                                <p class="text-muted">Additional rooms within the property, not considered as primary
                                    living
                                    spaces.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="additional_room"
                                                name="additional_room" placeholder="Additional Rooms"
                                                value="{{ $product->type_detail->additional_room }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-door-open"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="additional_room_bonus"
                                                name="additional_room_bonus" placeholder="Additional Room Bonus"
                                                value="{{ $product->type_detail->additional_room_bonus }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-door-open"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bedrooms & Bonus -->
                            <div class="col-lg-6 mb-3">
                                <label for="bedroom" class="form-label">Bedrooms</label>
                                <p class="text-muted">Number of bedrooms in the property.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="bedroom" name="bedroom"
                                                placeholder="Bedrooms" value="{{ $product->type_detail->bedroom }}"
                                                readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-door-closed"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="bedroom_bonus"
                                                name="bedroom_bonus" placeholder="Bedroom Bonus"
                                                value="{{ $product->type_detail->bedroom_bonus }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-door-closed"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bathrooms & Bonus -->
                            <div class="col-lg-6 mb-3">
                                <label for="bathroom" class="form-label">Bathrooms</label>
                                <p class="text-muted">Number of bathrooms available in the property.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="bathroom" name="bathroom"
                                                placeholder="Bathrooms" value="{{ $product->type_detail->bathroom }}"
                                                readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-water"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="bathroom_bonus"
                                                name="bathroom_bonus" placeholder="Bathroom Bonus"
                                                value="{{ $product->type_detail->bathroom_bonus }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-water"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Garages & Bonus -->
                            <div class="col-lg-6 mb-3">
                                <label for="garage" class="form-label">Garages</label>
                                <p class="text-muted">Number of garages or parking spaces included with the property.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="garage" name="garage"
                                                placeholder="Garages" value="{{ $product->type_detail->garage }}"
                                                readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-car-front"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="garage_bonus"
                                                name="garage_bonus" placeholder="Garage Bonus"
                                                value="{{ $product->type_detail->garage_bonus }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-car-front"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kitchens & Bonus -->
                            <div class="col-lg-6 mb-3">
                                <label for="kitchen" class="form-label">Kitchens</label>
                                <p class="text-muted">Number of kitchens available within the property.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="kitchen" name="kitchen"
                                                placeholder="Kitchens" value="{{ $product->type_detail->kitchen }}"
                                                readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-egg-fried"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="kitchen_bonus"
                                                name="kitchen_bonus" placeholder="Kitchen Bonus"
                                                value="{{ $product->type_detail->kitchen_bonus }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-egg-fried"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Living Rooms & Bonus -->
                            <div class="col-lg-6 mb-3">
                                <label for="living_room" class="form-label">Living Rooms</label>
                                <p class="text-muted">Number of living rooms in the property, designed for daily
                                    activities.</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="living_room"
                                                name="living_room" placeholder="Living Rooms"
                                                value="{{ $product->type_detail->living_room }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-house-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="living_room_bonus"
                                                name="living_room_bonus" placeholder="Living Room Bonus"
                                                value="{{ $product->type_detail->living_room_bonus }}" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-house-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <!-- Input for the map embed code -->
                                <div class="form-group">
                                    <label for="mapEmbedCode">Map Embed Code:</label>
                                    <textarea name="map_embed_code" id="mapEmbedCode" class="form-control" placeholder="Paste your map embed code here"
                                        rows="5">{{ old('map_embed_code', $productInformationDetail->map_embed_code ?? '') }}</textarea>

                                    <!-- Error message for map_embed_code -->
                                    @if ($errors->has('map_embed_code'))
                                        <div class="text-danger">
                                            <ul>
                                                @foreach ($errors->get('map_embed_code') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <!-- Preview iframe -->
                                <div class="form-group" id="mapPreviewContainer" style="display: none;">
                                    <label>Preview:</label>
                                    <div id="mapPreview" class="embed-responsive embed-responsive-16by9">
                                        <!-- Preview iframe will be inserted here -->
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const mapEmbedCodeInput = document.getElementById("mapEmbedCode");
                                    const mapPreviewContainer = document.getElementById("mapPreviewContainer");
                                    const mapPreview = document.getElementById("mapPreview");

                                    function updatePreview() {
                                        const embedCode = mapEmbedCodeInput.value.trim();

                                        // Only show preview if there's a value
                                        if (embedCode) {
                                            mapPreviewContainer.style.display = "block"; // Show preview container
                                            mapPreview.innerHTML = "";

                                            // Create iframe element
                                            const iframe = document.createElement("iframe");
                                            iframe.setAttribute("class", "embed-responsive-item");
                                            iframe.setAttribute("srcdoc", embedCode); // Set srcdoc with embed code
                                            iframe.setAttribute("frameborder", "0");
                                            iframe.setAttribute("allowfullscreen", "");

                                            // Append iframe to preview container
                                            mapPreview.appendChild(iframe);
                                        } else {
                                            mapPreviewContainer.style.display = "none"; // Hide preview if no value
                                        }
                                    }

                                    // Initialize preview based on existing value
                                    updatePreview();

                                    // Update preview on input change
                                    mapEmbedCodeInput.addEventListener("input", updatePreview);
                                });
                            </script>

                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Details</button>
                    </form>
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
                            <input type="text" id="priceInput" class="form-control" placeholder="Masukkan harga"
                                required value="{{ $product->price->price ?? '' }}">
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
                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                        id="checkAllBtn">Check
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
