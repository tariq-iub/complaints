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
                <div class="card shadow-none border" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0">
                                    Sections
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group">
                            @foreach($sections as $row)
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                   data-id="{{ $row->id }}">
                                    {{ ucwords($row->title) }}
                                    <span class="badge badge-phoenix badge-phoenix-info rounded-pill">
                                        {{ $row->handlers_count }}
                                    </span>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="handlers-data">
                <div class="card shadow-none border" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0">
                                    Section Name
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <label for="user_id" class="form-label">Select User</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option selected disabled>Choose a user...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                        <button type="submit" class="btn btn-primary">Add User</button>
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
                            <label for="edit_user_id" class="form-label">Select User</label>
                            <select class="form-select" id="edit_user_id" name="user_id" required>
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


@endsection

@push("scripts")
    <script>
        $(".list-group-item").on("click", function() {
            let id = $(this).data('id');
            $(".list-group-item-success").removeClass('list-group-item-success');
            $(this).addClass('list-group-item-success');
            $.get(`{{ url('/api/section_handlers') }}/${id}`, function(response) {
                $("#handlers-data").html(response);
            });
        });

        function OpenModal(id) {
            $("#section_id").val(id);
            $("#handlerModal").modal("show");
        }

        // Handle the form submission
        $("#linkUserForm").on("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission
            let formData = $(this).serialize();
            $.post("{{ url('/api/section_handlers') }}", formData, function(response) {
                if (response.success) {
                    $("#handlerModal").modal("hide");
                    // Optionally reload the handlers list
                    let sectionId = $("#section_id").val();
                    $.get(`{{ url('/api/section_handlers') }}/${sectionId}`, function(response) {
                        $("#handlers-data").html(response);
                    });
                } else {
                    // Handle errors
                }
            });
        });
        // Function to open the edit modal and populate fields
        function openEditModal(handlerId) {
            $.get(`/handlers/${handlerId}/edit`, function(response) {
                const handler = response.handler;
                const users = response.users;
                const sections = response.sections;

                // Set handler data
                $("#edit_handler_id").val(handler.id);
                $("#edit_is_head").val(handler.is_head);

                // Populate users dropdown
                let userOptions = '';
                users.forEach(user => {
                    const selected = user.id == handler.user_id ? 'selected' : '';
                    userOptions += `<option value="${user.id}" ${selected}>${user.name}</option>`;
                });
                $("#edit_user_id").html(userOptions);

                // Populate sections dropdown
                let sectionOptions = '';
                sections.forEach(section => {
                    const selected = section.id == handler.section_id ? 'selected' : '';
                    sectionOptions += `<option value="${section.id}" ${selected}>${section.name}</option>`;
                });
                $("#edit_section_id").html(sectionOptions);

                $("#editHandlerModal").modal("show");
            });
        }

$("#editHandlerForm").on("submit", function(event) {
    event.preventDefault();
    let handlerId = $("#edit_handler_id").val();
    let formData = $(this).serialize();

    $.ajax({
        url: `/handlers/${handlerId}`,
        type: 'PUT',
        data: formData,
        success: function(response) {
            if (response.success) {
                $("#editHandlerModal").modal("hide");
                location.reload();
            } else {
                alert('Failed to update handler.');
            }
        }
    });
});


        // Function to confirm deletion and delete the handler
        function confirmDelete(handlerId) {
            if (confirm('Are you sure you want to delete this handler?')) {
                $.ajax({
                    url: `/handlers/${handlerId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Optionally reload the handlers list
                            let sectionId = $("#section_id").val();
                            $.get(`/api/section_handlers/${sectionId}`, function(response) {
                                $("#handlers-data").html(response);
                            });
                        } else {
                            // Handle errors
                            alert('Failed to delete handler.');
                        }
                    }
                });
            }
        }
    </script>
@endpush

