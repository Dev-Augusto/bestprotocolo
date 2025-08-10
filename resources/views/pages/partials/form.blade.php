<!-- Contato -->
    <section id="contato" class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="section-title">Fale Conosco</h2>
                    <p class="section-subtitle">Estamos prontos para atender suas necessidades</p>
                </div>
                @if(session('success'))
                    <div class="text-bg-success  text-center">{{ session('success') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <form action="{{ route('send.message') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Seu Nome" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Seu Email">
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control" placeholder="Seu Telefone">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="description" rows="4" placeholder="Sua Mensagem" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Mensagem</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h4 class="mb-4">Informações de Contato</h4>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Av. Fidel de Castro, Estrada do Kikuxi, Viana, Luanda, Angola</p>
                        <p><i class="fas fa-phone me-2"></i> <a href="tel:976233933" class="text-muted">(244) 976 233 933</a></p>
                        <p><i class="fas fa-envelope me-2"></i> <a href="maito:geral@bestprotocolo.com" class="text-muted"> geral@bestprotocolo.com</a></p>
                        
                        <div class="social-media mt-4">
                            <h5 class="mb-3">Nos Siga</h5>
                            <a href="https://www.facebook.com/share/1FWumMk6DQ/?mibextid=wwXIfr" target="_blank" rel="external" class="me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                            <a href="https://www.instagram.com/best_protocolo?igsh=Y3Q3MXhkZW9lbHlh&utm_source=qr" target="_blank" rel="external" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="https://www.tiktok.com/@bestprotocolo?_t=ZM-8ylTYheYEyr&_r=1" target="_blank" rel="external" class="me-3"><i class="fab fa-tiktok fa-lg"></i></a>
                            <a href="https://wa.me/244976233933" target="_blank" rel="external" class="me-3"><i class="fab fa-whatsapp fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>