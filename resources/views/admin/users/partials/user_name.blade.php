@php
    $src = url('assets/img/users/user1.png');
    if($row->photo_path)
        $src = Storage::url($row->photo_path);
@endphp
<div class="d-flex align-items-center text-body text-hover-1000 ps-2">
    <div class="avatar avatar-m">
        <img class="rounded-circle" src="{{ $src }}" alt="">
    </div>
    <div class="mb-0 ms-3 fw-semibold">
        {{ $row->name }}
        <div class="text-info small">{{ $row->cnic_no }}</div>
    </div>
</div>
