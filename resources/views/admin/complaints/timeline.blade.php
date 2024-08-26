@extends('layouts.powereye')

@section('content')

<div class="container">
    <h2 class="my-4 text-center">Complaint Timeline</h2>
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            &larr; Back
        </a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="timeline">
                <!-- Complaint Added should always be first -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <span class="badge bg-secondary">Complaint Added:</span>
                        <div class="handler-info">
                            <strong>{{ $complaint->title }}</strong><br>
                            {{ $complaint->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Section Added -->
                @if($complaint->section_added_at && $complaint->section)
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <span class="badge bg-primary">Section Added:</span>
                            <div class="handler-info">
                                <strong>Section:</strong> {{ $complaint->section->title }}</span><br>
                                {{ $complaint->section_added_at->format('d M Y, H:i') }}
                            </div>
                        </div>                    </div>

                    <!-- Handler Assigned -->
                    @if($complaint->handler_assigned_at && $complaint->handler)
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <span class="badge bg-info">Handler Assigned:</span>
                                <div class="handler-info">
                                    <strong>Handler:</strong> {{ $complaint->handler->name }}
                                </div>
                                <div class="timestamp">
                                    {{ $complaint->handler_assigned_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Resolved -->
                @if($complaint->resolved_at)
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <span class="badge bg-success">Resolved:</span>
                            <div class="handler-info">
                                <strong>Resolved By:</strong> {{ $complaint->handler->name ?? 'N/A' }}</span><br>
                                {{ $complaint->resolved_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            @if($complaint->photo_path)
                <div class="complaint-image" id="image-container">
                    <img id="complaint-image" src="{{ asset('storage/' . $complaint->photo_path) }}" alt="Complaint Image" class="img-fluid rounded shadow">
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

<style>
.timeline {
    position: relative;
    padding: 2rem 0;
    margin: 0 auto;
    max-width: 800px;
    display: flex;
    flex-direction: column-reverse; /* Reverses the order */
}

.timeline-item {
    position: relative;
    padding: 1.5rem 0;
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.timeline-item:not(:last-child)::before {
    content: ''; 
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 100%;
    background-color: #d1d1d1;
}

.timeline-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 100%;
    background-color: #e6e6e6;
}

.timeline-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    background: linear-gradient(145deg, #ffffff, #e6e6e6);
    border: 2px solid #e6e6e6;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.timeline-item:first-child::after {
    background: linear-gradient(145deg, #bbbbbb, #a6a6a6);
}

.timeline-item:nth-child(2)::after {
    background: linear-gradient(145deg, #5a99d3, #477dbb);
}

.timeline-item:nth-child(3)::after {
    background: linear-gradient(145deg, #4fc3f7, #39a9d9);
}

.timeline-item:nth-child(4)::after {
    background: linear-gradient(145deg, #67e898, #4fcb75);
}

.badge {
    position: relative;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    text-align: center;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    margin-bottom: 0.5rem;
    z-index: 2;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.timeline-content {
    background: #ffffff;
    border-radius: 10px;
    padding: 0.75rem 1.25rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    position: relative;
    width: calc(50% - 3rem);
}

.timeline-item:nth-child(odd) .timeline-content {
    margin-right: auto;
}

.timeline-item:nth-child(even) .timeline-content {
    margin-left: auto;
}

.timeline-item:nth-child(odd) .timeline-content::after {
    content: '';
    position: absolute;
    top: 10px;
    right: -15px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent transparent transparent #ffffff;
}

.timeline-item:nth-child(even) .timeline-content::after {
    content: '';
    position: absolute;
    top: 10px;
    left: -15px;
    border-width: 10px;
    border-style: solid;
    border-color: transparent #ffffff transparent transparent;
}

.complaint-image {
    text-align: center;
    margin-top: 2rem;
    position: relative;
    overflow: hidden; /* Hides the overflow when zoomed */
}

.complaint-image img {
    max-width: 60%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    cursor: zoom-in;
    transition: transform 0.3s ease, transform-origin 0.3s ease;
}

.complaint-image img.zoomed {
    cursor: zoom-out;
    transform: scale(2); /* Adjust the scale as needed */
}

.section-name, .resolved-by {
    font-weight: normal; /* Makes the text unbold */
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const image = document.getElementById('complaint-image');
    const container = document.getElementById('image-container');

    if (image) {
        image.addEventListener('click', function() {
            image.classList.toggle('zoomed');
            if (image.classList.contains('zoomed')) {
                container.style.overflow = 'visible';
                container.style.position = 'relative';
                image.style.transformOrigin = 'center center'; // Center zoom
            } else {
                container.style.overflow = 'hidden';
                container.style.position = 'relative';
            }
        });

        container.addEventListener('mousemove', function(e) {
            if (image.classList.contains('zoomed')) {
                const rect = image.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const xPercent = (x / rect.width) * 100;
                const yPercent = (y / rect.height) * 100;

                image.style.transformOrigin = `${xPercent}% ${yPercent}%`;
            }
        });
    }
});
</script>
