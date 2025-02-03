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
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="checkAllBtn">Check All</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="uncheckAllBtn">Uncheck All</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Update Unit Facilities</button>
                    </form>
                </div>
            </div>

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

@section('scripts')
    <script>
        const priceInput = document.getElementById('price');
        const priceRawInput = document.getElementById('price-raw');

        priceInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^,\d]/g, '').toString();
            const split = value.split(',');
            const remainder = split[0].length % 3;
            let rupiah = split[0].substr(0, remainder);
            const thousands = split[0].substr(remainder).match(/\d{3}/g);

            if (thousands) {
                const separator = remainder ? '.' : '';
                rupiah += separator + thousands.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            e.target.value = rupiah ? 'Rp ' + rupiah : '';
            priceRawInput.value = value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
