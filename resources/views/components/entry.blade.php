<article class="entry card shadow-sm mb-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <div class="hostname badge bg-dark">{{ parse_url($link->original_url ?? "")['host'] ?? "" }}</div>
                &rarr;
                <div class="duosexagesimal-id badge bg-success">{{ $link->duosexagesimal_id ?? "" }}</div>
            </div>
            <div class="col text-end">
                <button type="button" class="created-at btn btn-outline-secondary btn-sm" disabled="disabled">
                    {{ $link->created_at ?? "" }}
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <strong class="col col-auto">Original:</strong>
            <div class="col">
                <a class="original-url" href="{{ $link->original_url ?? "" }}" rel="noopener">{{ $link->original_url ?? "" }}</a>
            </div>
        </div>
        <div class="border-top my-2"></div>
        <div class="row">
            <strong class="col col-auto">Shorten:</strong>
            <div class="col">
                <a class="shorten-url" href="{{ $link->shorten_url ?? "" }}" rel="noopener">{{ $link->shorten_url ?? "" }}</a>
            </div>
            <div class="col col-auto">
                <button type="button" class="visits-button btn btn-outline-primary btn-sm" disabled="disabled">
                    Visits&nbsp;<span class="visits-counter badge bg-primary">{{ $link->visits ?? "" }}</span>
                </button>
            </div>
        </div>
    </div>
</article>
