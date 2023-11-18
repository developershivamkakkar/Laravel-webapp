@extends('layouts.app');

@section('content')
    <section class="hero-small">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('{{ asset('assets/images/banner1.jpg') }}') ;">
                    <div class="hero-small-background-overlay"></div>
                    <div class="container  h-100">
                        <div class="row align-items-center d-flex h-100">
                            <div class="col-md-12">
                                <div class="block text-center">
                                    <span class="text-uppercase text-sm letter-spacing"></span>
                                    <h1 class="mb-3 mt-3 text-center">Blog & News</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 py-5">
        <div class="container">
            <h2> {{ $blog->name }} </h2>
            <div>
                <small>{{ date('d/m/Y', strtotime($blog->created_at)) }} </small>
            </div>
            @if (!empty($blog->image))
                <div class="mt-2">

                    <img src="{{ asset('uploads/blogs/thumb/large/' . $blog->image) }}"class="w-100">

                </div>
            @endif

            <div class="mt-3">
                {!! $blog->description !!}

            </div>
        </div>

    </section>
@endsection
