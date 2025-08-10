@extends('layouts.main')
@section('title', $service->name.' | Best Protocolo')
@section('content')
    <!-- Cabeçalho da Página -->
    <header class="page-header py-5" style="background-image: url('/img/garcons/img.jpg');
    width: 100%;
    background-size: cover;
    background-position: center;">
        <div class="container">
            <div class="row" >
                <div class="col text-white">
                    <h1 class="fw-bold">{{ $service->name }}</h1>
                    <p class="lead">{{ $service->description }}</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h2 class="mb-4 text-primary">{{ $service?->about?->title }}</h2>
                    {!! $service?->about?->description !!}
                    @php
                        $list = is_array($service?->about?->list) 
                        ? $service?->about?->list 
                        : json_decode($service?->about?->list, true);
                    @endphp
                    <ul class="list-unstyled">
                        @foreach ($list as $value)
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> {{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 mb-4">
                    <img src="{{ asset('storage/img/services/'.$service->slug.'/'. $service->image) }}" alt="{{ $service?->about?->title }}" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Galeria -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2>Nossos {{ $service->name }} em Acção</h2>
                    <p class="text-muted">Registros de eventos realizados</p>
                </div>
            </div>
            <div class="row">
                @foreach ($service?->images as $image)
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="{{ asset('storage/img/services/'.$service->slug.'/'. $image->img) }}" alt="{{ $service?->about?->title }}" witdh="100%"  height="300" class="img-fluid rounded">
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="#contato" class="btn btn-primary btn-lg">Contrate Nossos Serviços</a>
            </div>
        </div>
    </section>

    <!-- Depoimentos -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2>O Que Dizem Nossos Clientes</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($service?->clients as $client)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                @for($i = 0; $i <= ($client->stars - 1 ); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <p class="card-text">"{{ $client->description }}"</p>
                            <h5 class="card-title">{{ $client->name }}</h5>
                            <p class="text-muted">{{ $client->type }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection