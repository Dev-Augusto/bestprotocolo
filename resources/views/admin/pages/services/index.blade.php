@extends('layouts.admin')
@section('title', 'Editar Serviços | Best Protocolo')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">Lista de Serviços</h5>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Imagem</th>
                                <th>Nome do Serviço</th>
                                <th>Descrição</th>
                                <th style="width: 180px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/img/services/'.$service->slug.'/'. $service->image) }}" 
                                             alt="{{ $service->name }}" 
                                             style="width: 80px; height: 80px; object-fit: cover;"
                                             class="rounded">
                                    </td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ Str::limit($service->description, 80, '...') }}</td>
                                    <td>
                                        <a href="{{ route('admin.pages.services.show', $service->slug) }}" 
                                           class="btn btn-primary w-100">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhum serviço cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection