@extends('layouts.main')
@section('title','Parceiros | Best Protocolo')
@section('content')
<!-- Cabeçalho da Página -->
    <header class="page-header py-5" style="background-image: url('/img/garcons/img.jpg');
    width: 100%;
    background-size: cover;
    background-position: center;">
        <div class="container">
            <div class="row" >
                <div class="col text-white">
                    <h1 class="fw-bold">Nossos Parceiros</h1>
                    <p class="lead">Juntos criamos eventos extraordinários</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="text-primary">Relações de Confiança</h2>
                    <p class="lead">Trabalhamos com os melhores fornecedores do mercado</p>
                </div>
            </div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <p class="text-center">Nossa rede de parceiros é cuidadosamente selecionada para garantir que todos os aspectos do seu evento atendam aos mais altos padrões de qualidade. Conheça algumas das empresas que compartilham nosso compromisso com a excelência:</p>
                </div>
            </div>

            <!-- Parceiros -->
            <div class="row g-4">
                @foreach ($partners as $partner)
                    <div class="col-md-4 col-lg-3">
                        <div class="card partner-card h-100">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('storage/img/partners/'.$partner->image) }}" alt="Buffet Sabor & Arte" class="img-fluid mb-3" style="max-height: 80px;">
                                <h5>{{ $partner->name }}</h5>
                                <p class="text-muted">{{ $partner->profission }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="bg-light p-4 rounded">
                        <h3 class="text-primary mb-3">Torne-se nosso parceiro</h3>
                        <p class="mb-4">Se sua empresa compartilha nosso compromisso com qualidade e excelência, gostaríamos de conversar sobre possíveis parcerias.</p>
                        <a href="#contato" class="btn btn-primary btn-lg">Envie sua proposta</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection