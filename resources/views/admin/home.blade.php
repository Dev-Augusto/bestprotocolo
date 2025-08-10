@extends('layouts.admin')
@section('title','Admin | Best Protocolo')
@section('content')
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          <div class="row">
            <div class="col-lg-8">
              <!-- Card -->
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-0">Mensagens Recentes ({{ count($messages) }})</h4>
                </div>
                <div class="comment-widgets scrollable mb-2 common-widget" style="height: 265px" data-simplebar="">
                  @foreach ($messages as $message)
                  <!-- Comment Row -->
                  <div class="d-flex flex-row comment-row border-bottom p-3 gap-3">
                    <div>
                      <span><img src="/img/logo/logo.png" class="rounded-circle" alt="user"
                          width="50" /></span>
                    </div>
                    <div class="comment-text w-100">
                      <h6 class="fw-medium">{{ $message->name }}</h6>
                      <p class="mb-1 fs-2 text-muted">
                        {{ $message->description }}
                      </p>
                      <div class="comment-footer mt-2">
                        <div class="d-flex align-items-center">
                          <span class="
                              badge
                              bg-info-subtle
                              text-primary
                              
                            ">{{ $message?->email }} {{ ' | '.$message?->phone}}</span>
                          <span class="action-icons">
                            <a href="{{ route('delete.message', $message->id) }}" class="ps-3"><i class="ti ti-trash fs-5"></i></a>
                          </span>
                        </div>
                        <span class="
                            text-muted
                            ms-auto
                            fw-normal
                            fs-2
                            d-block
                            mt-2
                            text-end
                          ">{{ date('d M, Y',strtotime($message->created_at)) }}</span>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card overflow-hidden">
                <div class="card-body pb-0">
                  <div class="mt-4 pb-3 d-flex align-items-center">
                    <img src="/img/logo/favicon.png"  alt="user"
                          width="100%" height="100%" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection