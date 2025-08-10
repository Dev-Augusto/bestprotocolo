
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

            <!-- Removemos os atributos data-bs-toggle/data-bs-target -->
            <button class="navbar-toggler" type="button" id="custom-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- Home --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pages.home') ? 'active text-primary' : '' }}" 
                        href="{{ route('pages.home') }}">
                            Home
                        </a>
                    </li>

                    {{-- Serviços --}}
                    @foreach (DB::table('services')->limit(3)->get() as $service)
                        <li class="nav-item">
                            <a class="nav-link {{ url()->current() === route('pages.service', $service->slug) ? 'active text-primary' : '' }}"
                                href="{{ route('pages.service', $service->slug) }}">
                                    {{ $service->name }}
                            </a>
                        </li>
                    @endforeach

                    {{-- Parceiros --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pages.partners') ? 'active text-primary' : '' }}" 
                        href="{{ route('pages.partners') }}">
                            Parceiros
                        </a>
                    </li>

                    {{-- Quem Somos --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pages.about') ? 'active text-primary' : '' }}" 
                        href="{{ route('pages.about') }}">
                            Quem Somos
                        </a>
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
                        <a href="https://www.facebook.com/share/1FWumMk6DQ/?mibextid=wwXIfr" target="_blank" rel="external" class="text-white mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="https://www.instagram.com/best_protocolo?igsh=Y3Q3MXhkZW9lbHlh&utm_source=qr" target="_blank" rel="external" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="https://www.tiktok.com/@bestprotocolo?_t=ZM-8ylTYheYEyr&_r=1" target="_blank" rel="external" class="text-white mx-2"><i class="fab fa-tiktok fa-lg"></i></a>
                        <a href="https://wa.me/244976233933" target="_blank" rel="external" class="text-white mx-2"><i class="fab fa-whatsapp fa-lg"></i></a>
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
    <a href="https://wa.me/244976233933" class="whatsapp-float" target="_blank" data-bs-toggle="tooltip" data-bs-placement="left" title="Fale conosco pelo WhatsApp">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/scripts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>