@extends('template')

@section('page-heading')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manajemen Fasilitas</h3>
                    <p class="text-subtitle text-muted">Gunakan menu ini untuk mengelola fasilitas</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Fasilitas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage</li>
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

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Data Fasilitas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table table-striped dataTable-table" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($fasilitas as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td> <img id="icon-preview"
                                                        style="border-radius: 20px"
                                                            src="{{ env('URL_BE_ASSET') . $item->icon }}"
                                                            alt="Icon" class="img-thumbnail mt-2" width="35">
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>
                                                        <a href="{{ route('fasilitas.edit', $item->id) }}">
                                                            <button type="button" class="btn btn-primary">Edit</button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button id="{{ $item->id }}" type="button"
                                                            class="btn btn-danger btn-delete">Hapus</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">Data fasilitas tidak
                                                        ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">Anda Yakin Ingin Menghapus Data Fasilitas Ini?</h5>
                    <button type="button" class="close hide-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Data fasilitas terkait akan dihapus.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary hide-modal" data-dismiss="modal">Close</button>
                    <a class="btn-destroy" href="">
                        <button type="button" class="btn btn-danger ml-1 hide-modal" data-dismiss="modal">Hapus
                            Fasilitas</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script
        src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script>
        $(function() {
            var table = $('#table_data').DataTable({
                processing: true,
                serverSide: false,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: ['copyHtml5', {
                    extend: 'excelHtml5',
                    title: 'Data Export {{ \Carbon\Carbon::now()->year }}'
                }, 'csvHtml5'],
            });
        });

        $('body').on("click", ".btn-delete", function() {
            var id = $(this).attr("id");
            $(".btn-destroy").attr("href", window.location.origin + "/cms/fasilitas/" + id + "/destroy");
            $("#destroy-modal").modal("show");
        });
    </script>
@endpush
