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
            Manage handlers for different section along with section head.
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
                        <div>
                            <ul class="list-group">
                                @foreach($sections as $row)
                                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                       data-id="{{ $row->id }}">
                                        {{ $row->title }}
                                        <span class="badge badge-phoenix badge-phoenix-info rounded-pill">
                                            {{ $row->handlers_count }}
                                        </span>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
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
                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="handlerModal" tabindex="-1" aria-labelledby="linkUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkUserModalLabel">Link Handler</h5>
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
                                @php $users = []; @endphp
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
    </script>
@endpush
