
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/img/logo/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pages.home') }}">
                <span class="fw-bold">
                    <img src="/img/logo/logo.png" width="120" height="60" alt="">
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('pages.home') }}">Home</a>
                    </li>
                    @foreach (DB::table('services')->limit(3)->get() as $service)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.service',$service->slug) }}">{{ $service->name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.partners') }}">Parceiros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pages.about') }}">Quem Somos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Rodapé -->
    <footer class="py-4 bg-dark text-white">
        <div class="container">
            <div class="row align-items-center">
                <!-- Coluna de direitos autorais -->
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">&copy; 2023 Best Protocolo. Todos os direitos reservados.</p>
                </div>
                
                <!-- Coluna de redes sociais (centro) -->
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="social-links">
                        <a href="#" class="text-white mx-2" aria-label="Facebook">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="#" class="text-white mx-2" aria-label="Instagram">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="#" class="text-white mx-2" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in fa-lg"></i>
                        </a>
                        <a href="https://wa.me/SEUNUMERO" class="text-white mx-2" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Coluna de links legais -->
                <div class="col-md-4 text-center text-md-end">
                    <a href="#" class="text-white me-3">Termos de Serviço</a>
                    <a href="#" class="text-white">Política de Privacidade</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Botão WhatsApp Flutuante -->
    <a href="https://wa.me/5511999999999" class="whatsapp-float" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Fale conosco pelo WhatsApp">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/scripts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>