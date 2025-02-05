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
                    <h3> {{ $data->name }} - {{ $data->type_detail->name_id }} </h3>
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
                            {{ $data->name }} - {{ $data->type_detail->name_id }}
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#productAccordion">
                    <!-- Add `show` class to make it open by default -->
                    <div class="card-body">
                        <p>{!! $data->description_en !!}</p>
                        <p>{!! $data->concept_en !!}</p>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Promos:</h5>
                                <ul>
                                    @foreach ($data->promos ?? [] as $promo)
                                        <li>{{ $promo['name_en'] ?? 'No name available' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Facilities:</h5>
                                <ul>
                                    @foreach ($data->facilities ?? [] as $facility)
                                        <li>{{ $facility['name_en'] ?? 'No name available' }}</li>
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
                    <form action="{{ url('manage-product/price/' . $data->parent_id . '/' . $data->child_id . '/update') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $data->child_id }}">
                        </input>
                        <div class="form-group">
                            <label for="pricePrefix">Prefix</label>
                            <input name="price_prefix" type="text" id="pricePrefix"
                                value="{{ $data->price->prefix ?? '' }}" class="form-control"
                                placeholder="Misal: Dimulai Dari" required>
                        </div>

                        <div class="form-group">
                            <label for="priceInput">Price (Rupiah):</label>
                            <input type="text" id="priceInput" class="form-control" placeholder="Masukkan harga" required
                                value="{{ $data->price->price ?? '' }}">
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
