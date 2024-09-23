@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Complaints</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Complaints</h2>
        <p class="text-body-tertiary lead">
            Manage complaints and resolve issues efficiently.
        </p>
    </div>

    <div id="complaints" data-list='{"valueNames":["title","category","priority"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search complaints"
                               aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:15%;">
                            TITLE
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="category" style="width:25%;">
                            CATEGORY
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="priority" style="width:20%;">
                            PRIORITY
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="priority" style="width:20%;">
                            Section Name
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="priority" style="width:20%;">
                            Handler Name
                        </th>
                        <th class="sort align-middle text-end" scope="col">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="complaints-table-body">
                    @foreach ($complaints as $complaint)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="title align-middle white-space-nowrap">
                                {{ $complaint->title }}
                            </td>
                            <td class="category align-middle white-space-nowrap">
                                {{ $complaint->category->title }}
                            </td>
                            <td class="priority align-middle">
                                @if($complaint->priority == 'normal')
                                    <span class="badge badge-phoenix badge-phoenix-primary">Normal</span>
                                @elseif($complaint->priority == 'urgent')
                                    <span class="badge badge-phoenix badge-phoenix-warning">Urgent</span>
                                @elseif($complaint->priority == 'express')
                                    <span class="badge badge-phoenix badge-phoenix-danger">Express</span>
                                @endif
                            </td>
                            <td class="section align-middle">
                                {{ $complaint->section->title ?? 'Not Assigned Yet' }}
                            </td>
                            <td class="handler align-middle">
                                {{ $complaint->handler->name ?? 'Not Assigned Yet' }}
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
                                        <a class="dropdown-item text-primary" href="{{ route('complaints.timeline.show', $complaint->id) }}">
                                            View Timeline
                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editComplaintModal" data-id="{{ $complaint->id }}" data-section="{{ $complaint->section_id }}" data-handler="{{ $complaint->handler_id }}">
                                            Edit Section/Handler
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST"
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

    <!-- Edit Complaint Modal -->
    <div class="modal fade" id="editComplaintModal" tabindex="-1" aria-labelledby="editComplaintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editComplaintModalLabel">Edit Complaint Section/Handler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editComplaintForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="sectionSelect" class="form-label">Select Section</label>
                            <select id="sectionSelect" name="section_id" class="form-select">
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="handlerSelect" class="form-label">Select Handler</label>
                            <select id="handlerSelect" name="handler_id" class="form-select">
                                @foreach($handlers as $handler)
                                    <option value="{{ $handler->id }}">{{ $handler->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="complaint_id" id="complaintId">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editComplaintModal = document.getElementById('editComplaintModal');
            editComplaintModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var complaintId = button.getAttribute('data-id');
                var sectionId = button.getAttribute('data-section');
                var handlerId = button.getAttribute('data-handler');

                var form = document.getElementById('editComplaintForm');
                form.action = `/complaints/${complaintId}`;

                var sectionSelect = document.getElementById('sectionSelect');
                var handlerSelect = document.getElementById('handlerSelect');
                var complaintIdInput = document.getElementById('complaintId');

                complaintIdInput.value = complaintId;
                sectionSelect.value = sectionId;
                handlerSelect.value = handlerId;
            });
        });
    </script>
    @endpush
@endsection
