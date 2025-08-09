@extends('layouts.main')
@section('title','Quem Somos | Best Protocolo')
@section('content')
 <!-- Cabeçalho da Página -->
    <header class="page-header py-5" style="background-image: url('/img/garcons/img.jpg');
    width: 100%;
    background-size: cover;
    background-position: center;">
        <div class="container">
            <div class="row" >
                <div class="col text-white">
                    <h1 class="fw-bold">Quem Somos</h1>
                    <p class="lead">Excelência em serviços para eventos desde 2010</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Nossa História -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 class="text-primary mb-4">Nossa História</h2>
                    {!! $about->description !!}
                    @php
                        $list = is_array($about->list) 
                        ? $about->list 
                        : json_decode($about->list, true);
                    @endphp
                    <ul class="list-unstyled">
                        @foreach ($list as $value)
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> {{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 mb-4">
                    <img src="/img/logo/{{ $about->img }}" alt="Nossa equipe" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Missão, Visão e Valores -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="text-primary">Nossos Pilares</h2>
                    <p class="lead">O que nos guia em cada evento</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-bullseye text-primary fa-3x mb-3"></i>
                            <h3>Missão</h3>
                            <p>Proporcionar experiências excepcionais em eventos através de serviços profissionais que superam expectativas, garantindo conforto, segurança e elegância para clientes e convidados.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-eye text-primary fa-3x mb-3"></i>
                            <h3>Visão</h3>
                            <p>Ser reconhecida como a empresa líder em serviços para eventos na América Latina, mantendo nossos valores fundamentais e padrão de excelência em cada projeto realizado.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-heart text-primary fa-3x mb-3"></i>
                            <h3>Valores</h3>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Excelência no atendimento</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Profissionalismo ético</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Inovação constante</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Respeito à diversidade</li>
                                <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Compromisso com resultados</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('pages.partials.form')
@endsection