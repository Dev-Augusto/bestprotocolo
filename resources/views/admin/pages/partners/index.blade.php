@extends('layouts.admin')
@section('title', 'Editar Parceiros | Best Protocolo')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">Lista de Parceiros</h5>

                <!-- SEÇÃO 4 - Imagens Adicionais (collection) -->
                <div class="card mb-4">
                    <div class="card-body">
                       @include('admin.partials.alerts')
                        <form action="{{ route('admin.pages.partners.update') }}" method="POST" enctype="multipart/form-data" class="mb-5">
                            @csrf
                            @method('PUT')
                        {{-- Imagens já cadastradas --}}
                            <div class="row g-3 mb-4">
                                @foreach($partners as $partner)
                                    <div class="col-6 col-md-3 text-center">
                                        <div class="card shadow-sm h-100">
                                            <img src="{{ asset('storage/img/partners/'.$partner->image) }}" 
                                                alt="Imagem" 
                                                class="img-fluid rounded-top" 
                                                style="height:140px; object-fit:cover; width:100%;">
                                            <div class="card-body p-2">
                                                <input type="text" 
                                                    name="partner[{{ $partner->id }}][name]" 
                                                    class="form-control form-control-sm mb-2" value="{{ $partner->name }}" placeholder="Nome da Entidade">
                                                <input type="text" 
                                                    name="partner[{{ $partner->id }}][profission]" 
                                                    class="form-control form-control-sm mb-2" value="{{ $partner->profission }}" placeholder="Área de Actuação">
                                                {{-- Substituir imagem --}}
                                                <input type="file" 
                                                    name="partner[{{ $partner->id }}][image]" 
                                                    class="form-control form-control-sm mb-2">
                                               
                                                {{-- Remover --}}
                                                <div class="form-check">
                                                    <input class="form-check-input" 
                                                        type="checkbox" 
                                                        name="partner[{{ $partner->id }}][remove]" 
                                                        value="1" 
                                                        id="removeImage{{ $partner->id }}">
                                                    <label class="form-check-label small" for="removeImage{{ $partner->id }}">
                                                        Remover imagem
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Adicionar novas imagens --}}
                            <div class="border-top pt-3">
                                <h6 class="fw-bold mb-2">Adicionar Novas Imagens</h6>
                                <div id="newImagesWrapper" class="row g-3">
                                    <div class="col-12 col-md-12">
                                        <input type="text" name="partner[][name]" class="form-control mb-2 w-100" placeholder="Nome da Entidade">
                                        <input type="text" name="partner[][profission]" class="form-control mb-2 w-100" placeholder="Área de Actuação">
                                        <input type="file" name="partner[][image]" class="form-control mb-2 w-100">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addNewImage">
                                    + Adicionar outra imagem
                                </button>
                            </div>

                    </div>
                </div>
                    <div class="text-end mb-5">
                        <a href="{{ route('admin.pages.partners') }}" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('addNewImage').addEventListener('click', function () {
        const wrapper = document.getElementById('newImagesWrapper');
        const col = document.createElement('div');
        col.classList.add('col-12', 'col-md-12');
        col.innerHTML = `
            <input type="text" name="partner[][name]" class="form-control mb-2 w-100" placeholder="Nome da Entidade">
            <input type="text" name="partner[][profission]" class="form-control mb-2 w-100" placeholder="Área de Actuação">
            <input type="file" name="partner[][image]" class="form-control mb-2 w-100">
        `;
        wrapper.appendChild(col);
});
</script>
@endsection