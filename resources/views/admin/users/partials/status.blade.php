@if($row->status)
    <span class="badge fs-10 badge-phoenix badge-phoenix-success">
        <span class="badge-label">Active</span>
    </span>
@else
    <span class="badge fs-10 badge-phoenix badge-phoenix-warning">
        <span class="badge-label">Blocked</span>
    </span>
@endif
