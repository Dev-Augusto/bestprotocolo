@extends('layouts.main')
@section('title','Home | Best Protocolo')
@section('content')
     <!-- Hero Section com imagem fixa -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">{{ $slider->title }}</h1>
            <p class="lead mb-4 animate__animated animate__fadeInDown animate__delay-1s">{{ $slider->description }}</p>
            <a href="{{ $slider->url_btn }}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">{{ $slider->name_btn }}</a>
        </div>
    </section>
    <!-- Serviços -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="section-title">Nossos Serviços</h2>
                    <p class="section-subtitle">Soluções completas para seu evento</p>
                </div>
            </div>
            <div class="row">
                @foreach ($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100 card-hover-effect animate-on-scroll" data-animation-delay="100">
                        <div class="card-body text-center">
                            <i class="fas {{ $service->icon }} service-icon mb-3"></i>
                            <h3 class="card-title">{{ $service->name }}</h3>
                            <p class="card-text">{{ $service->description }}</p>
                            <a href="{{ route('pages.service', $service->slug) }}" class="btn btn-outline-primary">Saiba Mais</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <a href="{{ route('pages.about') }}" class="btn btn-primary mt-3">Conheça Nossa História</a>
            </div>
        </div>
    </section>
    @include('pages.partials.form')
@endsection