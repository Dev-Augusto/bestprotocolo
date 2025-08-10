@extends('layouts.admin')
@section('title', 'Editar Serviço | Best Protocolo')
@section('content')
@php
    // about list: garante array
    $aboutList = [];
    if ($service?->about && isset($service?->about->list)) {
        if (is_array($service?->about->list)) {
            $aboutList = $service?->about->list;
        } else {
            // tenta json decode seguro, senão string split por vírgula
            $decoded = json_decode($service?->about->list, true);
            if (is_array($decoded)) {
                $aboutList = $decoded;
            } else {
                $aboutList = array_filter(array_map('trim', explode(',', $service?->about->list)));
            }
        }
    }
@endphp
<div class="body-wrapper-inner">
    <div class="container-fluid">
        @include('admin.partials.alerts')
        <form action="{{ route('admin.pages.service.update',$service->id) }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            @method('PUT')
            <!-- SEÇÃO 1 - Informações do Serviço -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Informações do Serviço</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 text-center">
                            <label class="form-label d-block fw-semibold">Imagem Principal</label>
                            <img id="preview-main-image" src="{{ asset('storage/img/services/'.$service->slug.'/'. $service->image) }}" 
                                alt="{{ $service->name }}" class="img-fluid rounded mb-2" style="max-height:300px; object-fit:cover;">
                            <div class="mt-2">
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                <small class="text-muted">Deixe vazio para manter a imagem atual.</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nome do Serviço</label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ old('name', $service->name) }}" required>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descrição do Serviço</label>
                                <textarea name="description" rows="5" class="form-control" required>{{ old('description', $service->description) }}</textarea>
                                @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEÇÃO 2 - Sobre o Serviço (hasOne / belongsTo) -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Sobre o Serviço</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="about[title]" class="form-control"
                               value="{{ old('about.title', $service?->about?->title) }}">
                        @error('about.title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea name="about[description]" rows="3" class="form-control">{{ old('about.description', $service?->about?->description) }}</textarea>
                        @error('about.description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Lista (itens)</label>

                        <div id="about-list-wrapper">
                            @php
                                $oldList = old('about.list', $aboutList);
                            @endphp

                            @if(!empty($oldList) && count($oldList))
                                @foreach($oldList as $i => $item)
                                    <div class="input-group mb-2 about-list-item">
                                        <input type="text" name="about[list][]" class="form-control" value="{{ $item }}">
                                        <button type="button" class="btn btn-outline-danger remove-about-item">Remover</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2 about-list-item">
                                    <input type="text" name="about[list][]" class="form-control" value="">
                                    <button type="button" class="btn btn-outline-danger remove-about-item">Remover</button>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="button" id="add-about-item" class="btn btn-sm btn-primary mt-2">Adicionar item</button>
                        </div>
                        @error('about.list') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- SEÇÃO 3 - Cliente (hasOne / possible collection) -->
            @foreach ($service?->clients as $client)
                <div class="card mb-4">
                    <div class="card-header fw-bold">Cliente</div>
                    <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nome do Cliente</label>
                                <input type="text" name="clients[{{ $client->id }}][name]" class="form-control" value="{{ old('client.name', $client->name) }}">
                                @error('client.name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descrição do Cliente</label>
                                <textarea name="clients[{{ $client->id }}][description]" rows="3" class="form-control">{{ old('client.description', $client->description) }}</textarea>
                                @error('client.description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estrelas (0-5)</label>
                                <input type="number" id="client-star-input" name="clients[{{ $client->id }}][stars]" min="0" max="5" class="form-control" value="{{ old('client.star', $client->stars ?? 0) }}">
                                <div id="client-star-preview" class="mt-2">
                                    @php $stars = old('client.stars', $client->stars ?? 0); @endphp
                                    @for($i=0;$i<$client->stars;$i++)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @endfor
                                </div>
                                @error('client.stars') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo / Profissão</label>
                                <input type="text" name="clients[{{ $client->id }}][type]" class="form-control" value="{{ old('client.type', $client->type) }}">
                                @error('client.type') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </hr>
                    </div>
                </div>
            @endforeach

            <!-- SEÇÃO 4 - Imagens Adicionais (collection) -->
            <div class="card mb-4">
                <div class="card-header fw-bold">Imagens Adicionais</div>
                <div class="card-body">
                    
                    {{-- Imagens já cadastradas --}}
                    @if($service?->images && $service?->images->count())
                        <div class="row g-3 mb-4">
                            @foreach($service?->images as $img)
                                <div class="col-6 col-md-3 text-center">
                                    <div class="card shadow-sm h-100">
                                        <img src="{{ asset('storage/img/services/'.$service->slug.'/'. $img->img) }}" 
                                            alt="Imagem" 
                                            class="img-fluid rounded-top" 
                                            style="height:140px; object-fit:cover; width:100%;">
                                        <div class="card-body p-2">
                                            
                                            {{-- Substituir imagem --}}
                                            <input type="file" 
                                                name="images[{{ $img->id }}][img]" 
                                                class="form-control form-control-sm mb-2">
                                            {{-- Remover --}}
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                    type="checkbox" 
                                                    name="images[{{ $img->id }}][remove]" 
                                                    value="1" 
                                                    id="removeImage{{ $img->id }}">
                                                <label class="form-check-label small" for="removeImage{{ $img->id }}">
                                                    Remover imagem
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Nenhuma imagem adicional cadastrada.</p>
                    @endif

                    {{-- Adicionar novas imagens --}}
                    <div class="border-top pt-3">
                        <h6 class="fw-bold mb-2">Adicionar Novas Imagens</h6>
                        <div id="newImagesWrapper" class="row g-3">
                            <div class="col-12 col-md-4">
                                <input type="file" name="images[][img]" class="form-control mb-2">
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addNewImage">
                            + Adicionar outra imagem
                        </button>
                    </div>

                </div>
            </div>

            <div class="text-end mb-5">
                <a href="{{ route('admin.pages.services') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts para UX (adicionar item about e preview de imagem/estrelas) -->
<script>
document.getElementById('addNewImage').addEventListener('click', function () {
        const wrapper = document.getElementById('newImagesWrapper');
        const col = document.createElement('div');
        col.classList.add('col-12', 'col-md-4');
        col.innerHTML = `
            <input type="file" name="images[][img]" class="form-control mb-2">
        `;
        wrapper.appendChild(col);
});

document.addEventListener('DOMContentLoaded', function () {
    // add/remove about list items
    const wrapper = document.getElementById('about-list-wrapper');
    const addBtn = document.getElementById('add-about-item');

    addBtn.addEventListener('click', function () {
        const group = document.createElement('div');
        group.className = 'input-group mb-2 about-list-item';
        group.innerHTML = `
            <input type="text" name="about[list][]" class="form-control" value="">
            <button type="button" class="btn btn-outline-danger remove-about-item">Remover</button>
        `;
        wrapper.appendChild(group);
    });

    wrapper.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.remove-about-item')) {
            const parent = e.target.closest('.about-list-item');
            if (parent) parent.remove();
        }
    });

    // preview main image after select
    const fileInput = document.getElementById('image');
    if (fileInput) {
        fileInput.addEventListener('change', function (ev) {
            const file = ev.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                let preview = document.getElementById('preview-main-image');
                if (preview && preview.tagName !== 'IMG') {
                    // se era um div placeholder, substitui por img
                    const img = document.createElement('img');
                    img.id = 'preview-main-image';
                    img.className = 'img-fluid rounded mb-2';
                    img.style.maxHeight = '300px';
                    img.style.objectFit = 'cover';
                    preview.parentNode.replaceChild(img, preview);
                    preview = img;
                }
                if (preview) preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // client star preview
    const starInput = document.getElementById('client-star-input');
    const starPreview = document.getElementById('client-star-preview');
    if (starInput) {
        starInput.addEventListener('input', function () {
            const n = Math.max(0, Math.min(5, parseInt(this.value) || 0));
            starPreview.innerHTML = '';
            for (let i = 0; i < n; i++) {
                const iEl = document.createElement('i');
                iEl.className = 'bi bi-star-fill text-warning';
                starPreview.appendChild(iEl);
            }
        });
    }
});
</script>
@endsection
