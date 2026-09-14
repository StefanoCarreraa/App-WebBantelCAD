@if($activity->status === 'REALIZADA' && $activity->evidences->count() > 0)
    <hr class="my-4">
    <h4 class="fw-bold mb-3">Evidencias y Fotografías de la Actividad</h4>
    <div class="row g-3">
        @foreach($activity->evidences as $evidence)
            <div class="col-md-4 col-6">
                <a href="{{ asset('storage/' . $evidence->image_path) }}" target="_blank">
                    <img src="{{ asset('storage/' . $evidence->image_path) }}" class="img-fluid rounded shadow-sm" alt="{{ $evidence->caption }}">
                </a>
                @if($evidence->caption)
                    <p class="small text-muted mt-1">{{ $evidence->caption }}</p>
                @endif
            </div>
        @endforeach
    </div>
@endif