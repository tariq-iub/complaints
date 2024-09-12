@extends('layouts.app')

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
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                <thead>
                <tr>
                    <th class="sort align-middle" scope="col" data-sort="user" style="width:30%; min-width:200px;">User</th>
                    <th class="sort align-middle" scope="col" data-sort="email" style="width:30%; min-width:200px;">Email</th>
                    <th class="sort align-middle" scope="col" data-sort="contact_no" style="width:10%;">Contact No</th>
                    <th class="sort align-middle" scope="col" data-sort="role" style="width:10%;">Role</th>
                    <th class="sort align-middle" scope="col" data-sort="status" style="width:10%;">Status</th>
                    <th class="no-sort align-middle text-end">Action</th>
                </tr>
                </thead>
                <tbody class="list">
                @foreach($users as $row)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap user">
                            @php
                                $src = url('assets/img/users/user1.png');
                                if($row->photo_path)
                                    $src = Storage::url($row->photo_path);
                            @endphp
                            <div class="d-flex align-items-center text-body text-hover-1000 ps-2">
                                <div class="avatar avatar-m">
                                    <img class="rounded-circle" src="{{ $src }}" alt="">
                                </div>
                                <div class="mb-0 ms-3 fw-semibold">
                                    {{ $row->name }}
                                    <div class="text-info small">{{ $row->cnic_no }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="email align-middle white-space-nowrap email">
                            <a class="fw-semibold" href="mailto:{{ $row->email }}">
                                {{ $row->email }}
                                @if($row->email_verified_at == null)
                                    <div class="text-danger-emphasis small">Not Verified</div>
                                @else
                                    <div class="text-success-emphasis small">Verified</div>
                                @endif
                            </a>
                        </td>

                        <td class="align-middle contact_no">
                            {{ $row->contact_no }}
                        </td>

                        <td class="role align-middle white-space-nowrap text-body role">
                            {{ $row->role->title }}
                        </td>

                        <td class="align-middle status">
                            @if($row->status)
                                <span class="badge badge-phoenix badge-phoenix-success">
                                    <span class="badge-label">Active</span>
                                </span>
                            @else
                                <span class="badge badge-phoenix badge-phoenix-warning">
                                    <span class="badge-label">Blocked</span>
                                </span>
                            @endif
                        </td>

                        <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                            <div class="btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                    <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                    <a class="dropdown-item" href="{{ route('users.edit', $row->id) }}">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="document.querySelector(`#update-status-{{ $row->id }}`).submit();">
                                        Change Status
                                    </a>
                                    <form id="update-status-{{ $row->id }}" action="{{ route('users.status', $row->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="status" value="{{ !$row->status }}">
                                    </form>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0)">Remove</a>
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
                    <a class="fw-semibold" href="javascript:void(0)" data-list-view="*">
                        View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                    </a>
                    <a class="fw-semibold d-none" href="javascript:void(0)" data-list-view="less">
                        View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
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
@endsection

@push("scripts")
    <script>

    </script>
@endpush
