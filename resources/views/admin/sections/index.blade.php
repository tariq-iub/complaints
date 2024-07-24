@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Sections</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Sections</h2>
        <p class="text-body-tertiary lead">
            Manage sections in factories.
        </p>
    </div>

    <div id="sections" data-list='{"valueNames":["title","factory","address"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search sections"
                               aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary me-2" href="{{ route('sections.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Add Section
                    </a>

                    <a class="btn btn-primary" href="{{ route('handlers.index') }}">
                        <span class="fas fa-users me-2"></span>
                        Manage Handlers
                    </a>
                </div>
            </div>
        </div>
        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:20%; min-width:200px;">
                            SECTION TITLE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="factory" style="width:20%; min-width:200px;">
                            FACTORY NAME
                        </th>
                        <th class="sort align-middle pe-3" scope="col" data-sort="address" style="width:20%; min-width:200px;">
                            FACTORY ADDRESS
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%; min-width:200px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="sections-table-body">
                    @foreach($sections as $section)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="customer align-middle white-space-nowrap">
                                <a class="d-flex align-items-center text-body text-hover-1000 ps-2" href="#">
                                    <h6 class="mb-0 ms-3 fw-semibold">{{ $section->title }}</h6>
                                </a>
                            </td>
                            <td class="factory align-middle white-space-nowrap">
                                {{ $section->factory->title }}
                            </td>
                            <td class="email align-middle white-space-nowrap">
                                {{ $section->factory->address }}
                            </td>
                            <td class="actions align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window"
                                        aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true"
                                             focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                  d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z">
                                            </path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('sections.edit', $section) }}">
                                            Edit
                                        </a>

                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('sections.destroy', $section) }}" method="POST"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit">Remove</button>
                                        </form>
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

@endsection
