@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5">Users List</h2>
    <div id="users" data-list='{"valueNames":["user","email","contact_no","role","status"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search users" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('users.create') }}">
                        <span class="fas fa-plus me-2"></span>Add user
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar mb-3">
                <table class="table table-sm fs-9 mb-0" id="userTable">
                    <thead>
                        <tr>
                            <th class="sort align-middle" scope="col" data-sort="user" style="width:30%; min-width:200px;">User</th>
                            <th class="sort align-middle" scope="col" data-sort="email" style="width:30%; min-width:200px;">Email</th>
                            <th class="sort align-middle" scope="col" data-sort="contact_no" style="width:10%;">Contact No</th>
                            <th class="sort align-middle" scope="col" data-sort="role" style="width:10%; min-width:100px;">Role</th>
                            <th class="sort align-middle" scope="col" data-sort="status" style="width:10%;">Status</th>
                            <th class="no-sort align-middle text-end">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        $(document).ready(function() {
            var table = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {
                        data: 'user_name',
                        name: 'user_name',
                        createdCell: function (td) {
                            $(td).addClass('align-middle white-space-nowrap name');
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        createdCell: function (td) {
                            $(td).addClass('align-middle white-space-nowrap email');
                        }
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no',
                        createdCell: function (td) {
                            $(td).addClass('align-middle white-space-nowrap text-body contact_no');
                        }
                    },
                    {
                        data: 'role',
                        name: 'role',
                        createdCell: function (td) {
                            $(td).addClass('align-middle white-space-nowrap text-body role');
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        createdCell: function (td) {
                            $(td).addClass('py-2 align-middle text-body status');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action', orderable: false, searchable: false,
                        createdCell: function (td) {
                            $(td).addClass('last_active align-middle text-end white-space-nowrap text-body-tertiary');
                        }
                    },
                ],
                rowCallback: function(row, data, index) {
                    $(row).addClass('hover-actions-trigger btn-reveal-trigger position-static');
                }
            });
        });
    </script>
@endpush
