@extends('layouts.app')

@section('content')
    <section>
        <x-background></x-background>
    </section>
    <main class="container pt-5 min-h-100">
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
                    {{ $links->links() }}
                </div>
            </div>
            <div id="entries">
                @forelse($links as $link)
                    <x-entry :link="$link"></x-entry>
                @empty
                    <h1 id="noEntries" class="mt-5 text-center text-white fw-bolder text-uppercase display-4">Make your links shorter!</h1>
                @endforelse
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col col-auto">
                    {{ $links->links() }}
                </div>
            </div>
        </section>
    </main>
    <footer class="footer position-relative">
        <x-footer author="Tomasz Kisiel"></x-footer>
    </footer>
    <template id="templateEntry">
        <x-entry></x-entry>
    </template>
@endsection


