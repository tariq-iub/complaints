<div class="btn-reveal-trigger position-static">
    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
            type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
        <span class="fas fa-ellipsis fs-10"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-end py-2" style="">
        <a class="dropdown-item" href="{{ route('users.edit', $row->id) }}">Edit</a>
        <a class="dropdown-item" href="javascript:void(0)"
           onclick="document.querySelector(`#update-status-{{ $row->id }}`).submit();">
            Change Status
        </a>
        <form id="update-status-{{ $row->id }}" action="{{ route('users.status', $row->id) }}" method="POST" style="display:none;">
            @csrf
            @method("PUT")
            <input type="hidden" name="status" value="{{ !$row->status }}">
        </form>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="javascript:void(0)">Remove</a>
    </div>
</div>
