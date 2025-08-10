@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{!! Session::get('success') !!}</strong>
    </div>
@endif

@if (Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif


@if (Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('warning') }}</strong>
    </div>
@endif


@if (Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('info') }}</strong>
    </div>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $error }}</strong>
        </div>
    @endforeach
@endif
