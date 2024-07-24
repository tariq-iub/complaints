<div class="card shadow-none border" data-component-card="data-component-card">
    <div class="card-header p-4 border-bottom bg-body">
        <div class="row g-3 justify-content-between align-items-center">
            <div class="col col-md">
                <h4 class="text-body mb-0">
                    {{ $data->title }}
                </h4>
            </div>

            <a class="col col-md-auto btn btn-sm btn-phoenix-primary preview-btn ms-2"
            data-bs-toggle="modal" data-bs-target="#handlerModal">
                <span class="fas fa-plus me-2"></span>
                Add New Handler
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Handler Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Is Head</th>
                    <th scope="col">Added At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->handlers as $key => $row)
                    <tr>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>
                            {{ $row->user->name }}
                        </td>
                        <td>
                            {{ $row->user->email }}
                        </td>
                        <td>
                            @if($row->is_head)
                            <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                <span class="badge-label">Yes</span>
                            </span>
                            @else
                            <span class="badge badge-phoenix fs-10 badge-phoenix-danger">
                                <span class="badge-label">No</span>
                            </span>
                            @endif
                        </td>
                        <td>
                            {{ $row->created_at->format("d-m-Y") }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
