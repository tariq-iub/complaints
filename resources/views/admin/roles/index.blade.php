@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Roles</h2>
        <p class="text-body-tertiary lead">Manage user roles and menu attachment.</p>
    </div>

    <div id="roles" data-list='{"valueNames":["title"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search roles" aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('roles.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Add Role
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:15%; min-width:150px;">Title</th>
                        <th class="sort align-middle" scope="col" data-sort="route" style="width:75%; min-width:200px;">Menus Attached</th>
                        <th class="sort align-middle text-end" scope="col" style="width:10%;">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($roles as $role)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle ps-3 title">
                                <h6 class="fw-semibold">{{ $role->title }}</h6>
                            </td>
                            <td class="align-middle">
                                @forelse($role->menus as $menu)
                                    <span class="badge badge-phoenix badge-phoenix-success">{{ $menu->title }}</span>
                                @empty
                                    <span class="text-warning">No menu is attached to this {{ $role->title }}.</span>
                                @endforelse
                            </td>
                            <td class="align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('menus.edit', $role->id) }}">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $role->id }}" data-bs-toggle="modal" data-bs-target="#menuAttachmentModal">Attach Manus</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $role->id }}" data-bs-toggle="modal" data-bs-target="#menuDetachmentModal">Detach Manus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="menuAttachmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                Menu Attachment
                            </h5>
                            <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span class="fas fa-times fs-9"></span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('roles.role_menu_attachment') }}">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="role-id" name="role_id" value="">
                                <div class="menu-list">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="menuDetachmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                Menu Detachment
                            </h5>
                            <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span class="fas fa-times fs-9"></span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('roles.role_menu_detachment') }}">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="detach-role-id" name="role_id" value="">
                                <div class="menu-list">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="#!" data-list-view="*">View all <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                    <a class="fw-semibold d-none" href="#!" data-list-view="less">View Less <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
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

@push('scripts')
    <script>
        $('#menuAttachmentModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = $(event.relatedTarget);
            // Extract info from data-* attributes
            var id = button.data('id');
            $('#role-id').val(id);
            // Body of modal
            var menu_list = $(this).find('.menu-list');

            $.get(`{{ url('/api/roles/attach_menus/${id}') }}`, function(response) {
                $(menu_list).html(response.list);
            });
        });

        $('#menuDetachmentModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = $(event.relatedTarget);
            // Extract info from data-* attributes
            var id = button.data('id');
            $('#detach-role-id').val(id);
            // Body of modal
            var menu_list = $(this).find('.menu-list');

            $.get(`{{ url('/api/roles/detach_menus/${id}') }}`, function(response) {
                $(menu_list).html(response.list);
            });
        });
    </script>
@endpush
