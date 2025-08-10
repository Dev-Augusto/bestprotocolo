@extends('layouts.admin')
@section('title', 'Editar Slider | Best Protocolo')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        @include('admin.partials.alerts')
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.pages.index.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title fw-semibold mb-4">Imagem do Slider</h5>
                            <div class="card">
                                <!-- Imagem atual -->
                                <img src="/img/slides/{{ $slider->img }}" 
                                     class="card-img-top img-fluid" 
                                     alt="Imagem do Slider"
                                     style="max-height: 300px; object-fit: cover;">
                                <div class="card-body">
                                    <!-- Alterar imagem -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label fw-bold">Alterar Imagem</label>
                                        <input type="file" name="img" id="image" class="form-control">
                                        <small class=" text-danger">Deixe vazio para manter a imagem atual.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Coluna com campos de texto -->
                        <div class="col-md-6">
                            <h5 class="card-title fw-semibold mb-4">Informações do Slider</h5>
                            <div class="card">
                                <div class="card-body">
                                    <!-- Título -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label fw-bold">Título</label>
                                        <input type="text" name="title" id="title" 
                                               class="form-control" 
                                               value="{{ old('title', $slider->title) }}" required>
                                    </div>

                                    <!-- Descrição -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label fw-bold">Descrição</label>
                                        <textarea name="description" id="description" rows="3" 
                                                  class="form-control" required>{{ old('description', $slider->description) }}</textarea>
                                    </div>

                                    <!-- Nome do botão -->
                                    <div class="mb-3">
                                        <label for="name_btn" class="form-label fw-bold">Nome do Botão</label>
                                        <input type="text" name="name_btn" id="name_btn" 
                                               class="form-control" 
                                               value="{{ old('name_btn', $slider->name_btn) }}">
                                    </div>

                                    <!-- URL do botão -->
                                    <div class="mb-3">
                                        <label for="url_btn" class="form-label fw-bold">URL do Botão</label>
                                        <input type="text" name="url_btn" id="url_btn" 
                                               class="form-control" 
                                               value="{{ old('url_btn', $slider->url_btn) }}">
                                    </div>

                                    <!-- Botões -->
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Salvar Alterações
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
