@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Factories</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Factories</h2>
        <p class="text-body-tertiary lead">
            Manage factory registration process.
        </p>
    </div>

    <div id="factories" data-list='{"valueNames":["title","owner_name","email","contact_no"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search users"
                               aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link text-body me-4 px-0">
                        <span class="fa-solid fa-file-export fs-9 me-2"></span>Export
                    </button>
                    <a class="btn btn-primary" href="{{ route('factories.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Add Factory
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:15%; min-width:200px;">
                            FACTORY DETAILS
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="owner_name" style="width:15%; min-width:200px;">
                            OWNER DETAILS
                        </th>
                        <th class="sort align-middle pe-3" scope="col" data-sort="email"
                            style="width:20%; min-width:200px;">
                            EMAIL
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="contact_no" style="width:10%;">
                            CONTACT
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%;  min-width:200px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="users-table-body">
                    @foreach($factories as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle ps-3">
                                <a class="d-flex align-items-center text-body text-hover-1000 ps-0" href="#">
                                    <h6 class="fw-semibold">
                                        {{ $row->title }}
                                    </h6>
                                </a>
                                <div class="small">
                                    {{ $row->address }}
                                </div>
                            </td>
                            <td class="align-middle pas-3">
                                <a class="d-flex align-items-center text-body text-hover-1000 ps-0" href="#">
                                    <h6 class="fw-semibold">{{ $row->owner_name }}</h6>
                                </a>
                                <div class="small">
                                    {{ $row->owner_cnic }}
                                </div>
                            </td>
                            <td class="mobile_number align-middle white-space-nowrap">
                                <a class="fw-semibold" href="mailto:{{ $row->email }}">
                                    {{ $row->email }}
                                </a>
                            </td>
                            <td class="city align-middle white-space-nowrap text-body">
                                {{ $row->contact_no }}
                            </td>
                            <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window"
                                        aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true"
                                             focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                        <a class="dropdown-item" href="{{ route('factories.edit', $row->id) }}">
                                            Edit
                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#linkUserModal" data-factory-id="{{ $row->id }}">
                                            Link User
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#!">
                                            Remove
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="#!" data-list-view="*">
                        View all
                        <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                    </a>
                    <a class="fw-semibold d-none" href="#!" data-list-view="less">
                        View Less
                        <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                    </a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev">
                        <span class="fas fa-chevron-left"></span>
                    </button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next">
                        <span class="fas fa-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Link User Modal -->
    <div class="modal fade" id="linkUserModal" tabindex="-1" aria-labelledby="linkUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkUserModalLabel">Link User to Factory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="linkUserForm">
                        @csrf
                        <input type="hidden" name="factory_id" id="factory_id">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select User</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option selected disabled>Choose a user...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="access_level" class="form-label">Access Level</label>
                            <select class="form-select" id="access_level" name="access_level" required>
                                <option value="owner">Owner</option>
                                <option value="employee">Employee</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Link User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(function () {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('factories.index') }}",
                columns: [
                    {data: 'file_name', name: 'file_name'},
                    {data: 'device', name: 'device'},
                    {data: 'component', name: 'component'},
                    {data: 'site', name: 'site'},
                    {data: 'factory', name: 'factory'},
                    {data: 'uploaded_at', name: 'uploaded_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                createdRow: function (row, data, dataIndex) {
                    $('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(7).addClass('text-center');
                    $('td', row).eq(8).addClass('text-center');
                },
            });
        });

        function deleteFile(ctrl, id) {
            if (confirm('Are you sure to delete this file?')) {
                fetch(`{{ url('data') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        $(ctrl).closest('tr').hide().remove();
                    });
            }
        }

        $("#factory_id").on("change", function () {
            var id = $(this).val();
            $("#site_id").empty();
            fetch(`{{ url('api/factories?id=') }}${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#site_id").append(`<option value=''>Select Site</option>`);
                    data.sites.forEach((item, index) => {
                        $("#site_id").append(`<option value='${item.id}'>${item.title}</option>`);
                    });
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation:' + error);
                });
        });

        $("#site_id").on("change", function () {
            var id = $(this).val();
            $("#component_id").empty();
            fetch(`{{ url('api/sites?id=') }}${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#component_id").append(`<option value=''>Not Applicable</option>`);
                    data.components.forEach((item, index) => {
                        $("#component_id").append(`<option value='${item.id}'>${item.title}</option>`);
                    });
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation:' + error);
                });
        });

        function OpenReplaceModal(id) {
            $("#record-id").val(id);
            $(".bd-replace-modal-lg").modal('show');
        }

        const form2 = document.querySelector('#replace-form');
        form2.addEventListener("submit", (event) => {
            event.preventDefault();

            const formData = new FormData(form2);
            fetch(`{{ url('api/data/replace') }}`, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var linkUserModal = document.getElementById('linkUserModal');
            if (linkUserModal) {
                linkUserModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget; // Button that triggered the modal
                    var factoryId = button.getAttribute('data-factory-id'); // Extract info from data-* attributes
                    var modalBodyInput = linkUserModal.querySelector('#factory_id');
                    console.log("Factory ID set in modal:", factoryId); // Debugging line
                    if (modalBodyInput) {
                        modalBodyInput.value = factoryId; // Set the factory ID in the hidden input field
                    }
                });

                var linkUserForm = document.getElementById('linkUserForm');
                if (linkUserForm) {
                    linkUserForm.addEventListener('submit', function(e) {
                        e.preventDefault(); // Prevent the default form submission

                        let formData = new FormData(this);
                        console.log("Form Data:", Array.from(formData.entries())); // Debugging line

                        fetch("{{ route('api.factory-users.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                                'Accept': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                // handle the response
                                if (data.success) {
                                    // Close the modal and refresh the page or show a success message
                                    alert('User linked successfully!');
                                    location.reload(); // Reload the page to reflect changes
                                } else {
                                    // Show error message
                                    alert('Error linking user: ' + data.message);
                                }
                            })
                            .catch(error => {
                                // Handle error
                                console.error('Error:', error);
                                alert('An error occurred while linking the user.');
                            });
                    });
                } else {
                    console.error('Form element #linkUserForm not found.');
                }
            } else {
                console.error('Modal element #linkUserModal not found.');
            }
        });

        linkUserForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = new FormData(this);
            console.log("Form Data:", Array.from(formData.entries())); // Debugging line

            fetch("{{ route('api.factory-users.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // handle the response
                    if (data.success) {
                        // Close the modal and refresh the page or show a success message
                        alert('User linked successfully!');
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        // Show error message
                        alert('Error linking user: ' + data.message);
                    }
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                    alert('An error occurred while linking the user.');
                });
        });
    </script>
@endpush
