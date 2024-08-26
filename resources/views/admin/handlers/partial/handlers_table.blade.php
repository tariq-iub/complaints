<table class="table table-striped">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Section</th>
            <th>Section Head</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($section->handlers as $handler)
            <tr>
                <td>{{ $handler->employee->name }}</td>
                <td>{{ $handler->section->title }}</td>
                <td>{{ $handler->is_head ? 'Yes' : 'No' }}</td>
                <td>
                    <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $handler->id }}" data-bs-toggle="modal" data-bs-target="#editHandlerModal">Edit</button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $handler->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
