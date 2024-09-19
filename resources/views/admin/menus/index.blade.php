@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Menus</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Menus</h2>
        <p class="text-body-tertiary lead">Manage the system menus.</p>
    </div>

    <div id="menus" data-list='{"valueNames":["title","route","icon","parent_id","display_order","status"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search menus" aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('menus.create') }}">
                        <span class="fas fa-plus me-2"></span>Add Menu
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1 mt-3">
                <table class="table table-sm fs-9">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:15%; min-width:150px;">Title</th>
                        <th class="sort align-middle" scope="col" data-sort="route" style="width:15%; min-width:150px;">Route</th>
                        <th class="sort align-middle" scope="col" data-sort="icon" style="width:10%; min-width:100px;">Icon</th>
                        <th class="sort align-middle" scope="col" data-sort="parent_id" style="width:15%; min-width:150px;">Parent Menu</th>
                        <th class="sort align-middle" scope="col" data-sort="display_order" style="width:10%;">Display Order</th>
                        <th class="sort align-middle" scope="col" data-sort="status" style="width:3%;">Status</th>
                        <th class="sort align-middle text-end" scope="col" style="width:10%;">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($menus as $menu)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle ps-3 title">
                                <h6 class="fw-semibold">{{ $menu->title }}</h6>
                            </td>
                            <td class="align-middle route">
                                <a class="fw-semibold" href="{{ $menu->route }}">{{ $menu->route }}</a>
                            </td>
                            <td class="align-middle icon">
                                @if($menu->icon)
                                    <span data-feather="{{ $menu->icon }}"></span>
                                    <span class="ms-2">
                                        {{ $menu->icon }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="align-middle parent_id">
                                {{ $menu->parent_id ? $menu->parent->title : '-' }}
                            </td>
                            <td class="align-middle">
                                <input type="number" id="display_order" class="form-control form-control-sm" style="width: 100px;"
                                       value="{{ $menu->display_order }}" onclick="ChangeOrder(this, {{ $menu->id }})">
                            </td>
                            <td class="py-2 align-middle text-body status">
                                @if($menu->status)
                                    <div class="badge fs-10 badge-phoenix badge-phoenix-success">
                                        <span class="fw-bold">Active</span>
                                    </div>
                                @else
                                    <div class="badge fs-10 badge-phoenix badge-phoenix-danger">
                                        <span class="fw-bold">Blocked</span>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-ellipsis fs-10"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('menus.edit', $menu->id) }}">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="document.getElementById('toggle-form{{ $menu->id }}').submit();">
                                            Change Status
                                        </a>
                                        <form method="POST" action="{{ route('menus.toggle', $menu->id) }}"
                                              class="d-none" id="toggle-form{{$menu->id}}">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $menus->links('pagination::bootstrap-5') }}
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function ChangeOrder(ctrl, id)
        {
            let value = $(ctrl).val();
            $.post("{{ url('/api/menus/update_order') }}", { id: id, value: value }, function(response) {
                if(response.success == true)
                    console.log('updated...');
            });
        }
    </script>
@endpush
