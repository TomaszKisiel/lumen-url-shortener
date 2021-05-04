@extends('layouts.app')

@section('content')
    <section class="px-4 mt-5 mb-4 pb-2 text-center">
        <div class="position-absolute start-0 end-0 top-0"
             style="height: 95%; z-index: -1; background: #295e8c;mix-blend-mode: normal;">
            <svg style="fill: #e4eaf1;position: absolute;bottom: 0;left: 0;right: 0;" viewBox="0 0 1000 100"
                 preserveAspectRatio="none">
                <path
                    d="M1000,40c0,0 -120.077,-38.076 -250,-38c-129.923,0.076 -345.105,78 -500,78c-154.895,0 -250,-30 -250,-30l0,50l1000,0l0,-60Z"></path>
                <path
                    d="M1000,40c0,0 -120.077,-38.076 -250,-38c-129.923,0.076 -345.105,73 -500,73c-154.895,0 -250,-45 -250,-45l0,70l1000,0l0,-60Z"
                    style="opacity:0.4"></path>
                <path
                    d="M1000,40c0,0 -120.077,-38.076 -250,-38c-129.923,0.076 -345.105,68 -500,68c-154.895,0 -250,-65 -250,-65l0,95l1000,0l0,-60Z"
                    style="opacity:0.4"></path>
            </svg>
        </div>
    </section>
    <main class="container">
        <section class="card shadow-sm mb-5 mx-auto" style="max-width: 768px">
            <div class="card-body p-4">
                <div class="row mb-2">
                    <div class="col">
                        <header class="d-flex gap-2 align-items-center">
                            <img class="d-block" src="static/logo.png" width="36" height="36"
                                 alt="URL Shortener's logo"/>
                            <h1 class="fw-bold m-0">URL Shortener</h1>
                        </header>
                    </div>
                </div>
                <form id="form" method="POST" action="/">
                    <div class="row align-items-end mb-2">
                        <div class="col">
                            <label for="shortener" class="form-label visually-hidden">URL to shorten</label>
                            <input type="url" class="form-control shadow-sm border-secondary" id="shortener"
                                   name="url" placeholder="Provide a link to shorten" required>
                        </div>
                        <div class="col col-auto">
                            <button type="submit" class="btn btn-dark border-secondary shadow-sm">Shorten</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="hiddenCheck" name="hidden">
                                <label class="form-check-label" for="hiddenCheck">
                                    Don't show this link on public list below
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="pt-1">
            <div class="row justify-content-center my-3">
                <div class="col col-auto">
                    {{ $urls->links() }}
                </div>
            </div>
            <div id="urls">
                @foreach ($urls as $url)
                    <article class="card shadow-sm mb-3">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="badge bg-dark">{{ parse_url($url->url)['host'] }}</div>
                                    &rarr;
                                    <div class="badge bg-success">{{ $url->duosexagesimalId }}</div>
                                </div>
                                <div class="col text-end">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" disabled="disabled">
                                        {{ $url->created_at }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <strong class="col col-auto">Original:</strong>
                                <div class="col">
                                    <a href="{{ $url->url }}" rel="noopener">{{ $url->url }}</a>
                                </div>
                            </div>
                            <div class="border-top my-2"></div>
                            <div class="row">
                                <strong class="col col-auto">Shorten:</strong>
                                <div class="col">
                                    <a href="{{ $url->shorten }}" rel="noopener">{{ $url->shorten }}</a>
                                </div>
                                <div class="col col-auto">
                                    <button type="button" class="btn btn-outline-primary btn-sm" disabled="disabled">
                                        Visits&nbsp;<span class="badge bg-primary">{{ $url->visits }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col col-auto">
                    {{ $urls->links() }}
                </div>
            </div>
        </section>
    </main>
    <footer class="footer position-relative">
        <svg style="fill:#ffffff" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path
                d="M1000,50l-182.69,-45.286l-292.031,61.197l-190.875,-41.075l-143.748,28.794l-190.656,-23.63l0,70l1000,0l0,-50Z"
                style="opacity:0.4"></path>
            <path
                d="M1000,57l-152.781,-22.589l-214.383,19.81l-159.318,-21.471l-177.44,25.875l-192.722,5.627l-103.356,-27.275l0,63.023l1000,0l0,-43Z"></path>
        </svg>
        <div class="bg-white">
            <div class="text-center pb-3 pb-md-4">
                Tomasz Kisiel &copy; 2021
            </div>
        </div>
    </footer>
    <template id="templateUrl">
        <article class="card shadow-sm mb-3">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div id="hostUrl" class="badge bg-dark"></div>
                        &rarr;
                        <div id="hashUrl" class="badge bg-success"></div>
                    </div>
                    <div class="col text-end">
                        <button id="createdAt" type="button" class="btn btn-outline-secondary btn-sm" disabled="disabled">

                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <strong class="col col-auto">Original:</strong>
                    <div class="col">
                        <a id="fullUrl" href="" rel="noopener"></a>
                    </div>
                </div>
                <div class="border-top my-2"></div>
                <div class="row">
                    <strong class="col col-auto">Shorten:</strong>
                    <div class="col">
                        <a id="shortenUrl" href="" rel="noopener"></a>
                    </div>
                    <div class="col col-auto">
                        <button id="visitsButton" type="button" class="btn btn-outline-primary btn-sm" disabled="disabled">
                            Visits&nbsp;<span id="visitsText" class="badge bg-primary"></span>
                        </button>
                    </div>
                </div>
            </div>
        </article>
    </template>
@endsection


