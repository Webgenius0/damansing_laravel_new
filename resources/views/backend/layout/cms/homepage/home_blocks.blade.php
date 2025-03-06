@php
use App\Models\Cms;
$cmsCount = Cms::where('page', 'homepage')
->where('section', 'create_home_blocks')
->count();
@endphp

@extends('backend.app')

@section('title', 'Home Block Page')

@push('style')
    <style>
        /* Custom DataTable Styling */
        .dataTables_wrapper {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Customize buttons and pagination */
        .action-wrapper {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn {
            color: #fff;
            background-color: #28a745;
        }

        .delete-btn {
            color: #fff;
            background-color: #dc3545;
        }

        .pagination-container a,
        .pagination-container span {
            color: #007bff;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
<main class="app-content content">
    <h2 class="section-title">Welcome Block</h2>

    <div class="card p-3 border rounded shadow-sm bg-white">
        <div class="card-body">
            <div class="table-responsive p-4">
                <!-- Button Positioned at Top Right -->
                <!-- <div class="d-flex justify-content-end">
                    <a href="{{ route('cms.get', ['section' => 'home_blocks_edit', 'page' => 'homepage']) }}" class="btn btn-primary" type="button">
                        <span>Add Block</span>
                    </a>
                </div> -->


                <div class="d-flex flex-column align-items-end">
                    <a href="{{ $cmsCount >= 4 ? '#' : route('cms.get', ['section' => 'home_blocks_edit', 'page' => 'homepage' ]) }}"
                        id="addTestimonialBtn"
                        class="btn btn-primary"
                        type="button"
                        @if($cmsCount>= 4)
                        aria-disabled="true"
                        class="btn btn-primary disabled"
                        tabindex="-1"
                        style="pointer-events: none; opacity: 0.65;"
                        @endif>
                        <span>Add</span>
                    </a>

                    @if($cmsCount >= 4)
                    <div class="mt-2">
                        <small class="text-danger">
                        You can only insert 4 items. Please delete or edit an existing item to add a new one.
                        </small>
                    </div>
                    @endif
                </div>

                <table id="basic_tables" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Content will be filled by DataTable -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        let dTable = $('#basic_tables').DataTable({
            order: [],
            destroy: true,
            lengthMenu: [
                [25, 50, 100, 200, 500, -1],
                [25, 50, 100, 200, 500, "All"]
            ],
            processing: true,
            serverSide: true,
            paging: true,
            language: {
                lengthMenu: "Show _MENU_ entries",
                processing: `<div class="text-center">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>`
            },
            ajax: {
                url: "{{ route('cms.get', ['section' => 'create_home_blocks', 'page' => 'homepage']) }}",
                type: "get",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description',
                    render: function(data, type, row) {
                        return data.length > 30 ? data.substr(0, 30) + '...' : data;
                    }
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Search and Pagination Handlers
        $('#customSearchBox').on('keyup', function() {
            dTable.search(this.value).draw();
        });

        $('#pageLength').on('change', function() {
            dTable.page.len(this.value).draw();
        });
    });

    function changeStatus(event, id) {
        event.preventDefault();
        // let statusUrl = '{{ route('faq.status', ':id') }}'.replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status of this dynamic page.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: statusUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Status Updated!',
                            response.success,
                            'success'
                        );
                        $('#basic_tables').DataTable().ajax.reload(); // Reload DataTable
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            response.responseJSON.error || 'An error occurred.',
                            'error'
                        );
                    }
                });
            }
        });
    }
    function showDeleteAlert(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteRecord(id);
                    }
                });
            }
    function deleteRecord(event, id) {
        event.preventDefault();
         let deleteUrl = "{{ route('cms.delete', ':id') }}".replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.success,
                            'success'
                        );
                        $('#basic_tables').DataTable().ajax.reload(); // Reload DataTable
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            response.responseJSON.error || 'An error occurred.',
                            'error'
                        );
                    }
                });
            }
        });
    }


    function showStatusChangeAlert(id) {
                event.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to update the status?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        statusChange(id);
                    }
                });
            }

            // Status Change
            function statusChange(id) {
                let url = "{{ route('cms.status', ':id') }}";
                $.ajax({
                    type: "GET",
                    url: url.replace(':id', id),
                    success: function(resp) {
                        console.log(resp);
                        // Reloade DataTable
                        $('#data-table').DataTable().ajax.reload();
                        if (resp.success === true) {
                            
                            // show toast message
                            toastr.success(resp.message);
                        } else if (resp.errors) {
                            toastr.error(resp.errors[0]);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function(error) {
                        // location.reload();
                    }
                })
            }
</script>
@endpush
