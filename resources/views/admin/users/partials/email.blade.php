<a class="fw-semibold" href="mailto:{{ $row->email }}">
    {{ $row->email }}
    @if($row->email_verified_at == null)
        <div class="text-danger-emphasis small">Not Verified</div>
    @else
        <div class="text-success-emphasis small">Verified</div>
    @endif
</a>
