@extends('layouts.main')
@section('title', 'Admin Login | Best Protocolo')
@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-4">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{ route('pages.home') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./assets/images/logos/logo.svg" alt="">
                </a>
                <p class="text-center">Admin | Best Protocolo</p>
                 <form method="POST" action="{{ route('admin.login.post') }}">
                     @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"   :value="old('email')" required autofocus autocomplete="username"aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Palavra Passe</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" required autocomplete="current-password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" id="remember_me" name="remember" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Lembrar me
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Acessar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
