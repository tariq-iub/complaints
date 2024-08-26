@extends('layouts.powereye')

@section('content')
    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Complaints</h2>
        <p class="text-body-tertiary lead">
            Assigned complaints
        </p>
    </div>

    <div id="complaints" data-list='{"valueNames":["title","category","priority","section","handler"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative" method="GET" action="{{ route('employee.complaints.index') }}">
                        <input class="form-control search-input search" type="search" name="search" placeholder="Search complaints" aria-label="Search" value="{{ request()->get('search') }}"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                        <tr>
                            <th class="sort align-middle" scope="col" data-sort="picture" style="width:10%; min-width:100px;">Picture</th>
                            <th class="sort align-middle" scope="col" data-sort="title" style="width:20%; min-width:200px;">Title</th>
                            <th class="sort align-middle" scope="col" data-sort="detail" style="width:20%; min-width:150px;">Detail</th>
                            <th class="sort align-middle" scope="col" data-sort="category" style="width:15%; min-width:150px;">Category</th>
                            <th class="sort align-middle" scope="col" data-sort="priority" style="width:10%; min-width:100px;">Priority</th>
                            <th class="sort align-middle" scope="col" data-sort="section" style="width:15%; min-width:150px;">Section</th>
                            <th class="sort align-middle" scope="col" data-sort="handler" style="width:15%; min-width:150px;">Handler</th>
                            <th class="sort align-middle text-end" scope="col" style="width:10%; min-width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="complaints-table-body">
                        @foreach($complaints as $complaint)
                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                <td class="picture align-middle">
                                    @if($complaint->photo_path)
                                        <img src="{{ asset('storage/' . $complaint->photo_path) }}" alt="Complaint Image" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal{{ $complaint->id }}">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="title align-middle">
                                    <h6>{{ $complaint->title }}</h6>
                                </td>
                                <td class="detail align-middle"
                                    data-bs-toggle="tooltip"
                                    title="{{ $complaint->detail }}"
                                    style="position: relative;"
                                >
                                    {{ Str::limit(preg_replace('/\s+/', ' ', $complaint->detail), 6, '...') }}
                                </td>
                                <td class="category align-middle">{{ $complaint->category->name ?? 'N/A' }}</td>
                                <td class="priority align-middle">
                                    @if($complaint->priority == 'normal')
                                        <span class="badge badge-phoenix badge-phoenix-primary">Normal</span>
                                    @elseif($complaint->priority == 'urgent')
                                        <span class="badge badge-phoenix badge-phoenix-warning">Urgent</span>
                                    @elseif($complaint->priority == 'express')
                                        <span class="badge badge-phoenix badge-phoenix-danger">Express</span>
                                    @endif
                                </td>
                                <td class="section align-middle">{{ $complaint->section->title?? 'Not Assigned Yet' }}</td>
                                <td class="handler align-middle">{{ $complaint->handler->name ?? 'N/A' }}</td>
                                <td class="actions align-middle text-end white-space-nowrap text-body-tertiary">
                                    <div class="btn-reveal-trigger position-static">
                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                            <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end py-2">
                                            <a class="dropdown-item text-primary" href="{{ route('timeline.show', $complaint->id) }}">View Timeline</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Image Modal -->
                            <div class="modal fade" id="imageModal{{ $complaint->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $complaint->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $complaint->photo_path) }}" alt="Complaint Image" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="#!" data-list-view="*">View all <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                    <a class="fw-semibold d-none" href="#!" data-list-view="less">View Less <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    boundary: 'window',
                    placement: 'top',
                    customClass: 'tooltip-white'
                });
            });
        });
    </script>
@endsection

<style>
    .tooltip-white .tooltip-inner {
        background-color: #fff;
        color: #000;
    }
</style>
