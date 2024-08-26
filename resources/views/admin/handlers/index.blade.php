@extends('layouts.powereye')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sections') }}">Sections</a></li>
            <li class="breadcrumb-item active">Handlers</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Manage Handlers</h2>
        <p class="text-body-tertiary lead">
            Manage handlers for different sections along with section heads.
        </p>
    </div>

    <div class="mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-none border">
                    <div class="card-header p-4 border-bottom bg-body">
                        <h4 class="text-body mb-0">Sections</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group">
                            @foreach($sections as $section)
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                   data-id="{{ $section->id }}">
                                    {{ ucwords($section->title) }}
                                    <span class="badge badge-phoenix badge-phoenix-info rounded-pill">
                                        {{ $section->handlers_count }}
                                    </span>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="handlers-data">
                <!-- Handlers data will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Add Handler Modal -->
    <div class="modal fade" id="handlerModal" tabindex="-1" aria-labelledby="handlerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="handlerModalLabel">Add Handler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="linkUserForm">
                        @csrf
                        <input type="hidden" name="section_id" id="section_id" value="">
                        <div class="mb-2">
                            <label for="employee_id" class="form-label">Select Employee</label>
                            <select class="form-select" id="employee_id" name="employee_id" required>
                                <option selected disabled>Choose an employee...</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="is_head" class="form-label">Section Head</label>
                            <select class="form-select" id="is_head" name="is_head" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Handler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Handler Modal -->
    <div class="modal fade" id="editHandlerModal" tabindex="-1" aria-labelledby="editHandlerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHandlerModalLabel">Edit Handler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editHandlerForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="handler_id" id="edit_handler_id">
                        <div class="mb-2">
                            <label for="edit_employee_id" class="form-label">Select Employee</label>
                            <select class="form-select" id="edit_employee_id" name="employee_id" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_is_head" class="form-label">Section Head</label>
                            <select class="form-select" id="edit_is_head" name="is_head" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_section_id" class="form-label">Select Section</label>
                            <select class="form-select" id="edit_section_id" name="section_id" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Handler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this handler?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Load handlers for a section when a section is clicked
        $('.list-group-item').click(function() {
            var sectionId = $(this).data('id');
            $("#section_id").val(sectionId);
            loadSectionHandlers(sectionId);
        });

        // Function to load section handlers
        function loadSectionHandlers(sectionId) {
            $.get("{{ url('/sections') }}/" + sectionId + "/handlers", function(response) {
                $("#handlers-data").html(response);
            }).fail(function() {
                $("#handlers-data").html('<p>An error occurred while loading data.</p>');
            });
        }

        // Handle the submission of the add handler form
        $('#linkUserForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.post("{{ route('section-handlers.store') }}", formData, function(response) {
                if (response.success) {
                    $("#handlerModal").modal("hide");
                    loadSectionHandlers($("#section_id").val());
                }
            }).fail(function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            });
        });

        // Populate edit modal with handler data
        $('#editHandlerModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var handlerId = button.data('id');
            $.get("{{ url('/section_handlers') }}/" + handlerId + "/edit", function(response) {
                $('#edit_handler_id').val(response.handler.id);
                $('#edit_employee_id').html(response.employees.map(emp => `<option value="${emp.id}">${emp.name}</option>`));
                $('#edit_section_id').html(response.sections.map(sec => `<option value="${sec.id}">${sec.title}</option>`));
                $('#edit_is_head').val(response.handler.is_head ? 1 : 0);
            });
        });

        // Handle the submission of the edit handler form
        $('#editHandlerForm').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var handlerId = $('#edit_handler_id').val();
            $.ajax({
                url: "{{ url('/section_handlers') }}/" + handlerId,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $("#editHandlerModal").modal("hide");
                        loadSectionHandlers($("#section_id").val());
                    }
                }
            });
        });

        // Show delete confirmation modal
        $('#handlers-data').on('click', '.delete-btn', function() {
            var handlerId = $(this).data('id');
            $('#confirmDeleteBtn').data('id', handlerId);
            $('#deleteConfirmationModal').modal('show');
        });

        // Handle delete confirmation
        $('#confirmDeleteBtn').click(function() {
            var handlerId = $(this).data('id');
            $.ajax({
                url: "{{ url('/section_handlers') }}/" + handlerId,
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        $('#deleteConfirmationModal').modal('hide');
                        loadSectionHandlers($("#section_id").val());
                    }
                }
            });
        });
    });
</script>
@endpush
