@if (count($errors) > 0)
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
@endif

@if(session()->has('success'))

    <div class="alert alert-success" style="width: 80%; margin:auto;">
        {{ session('success') }}
    </div>

@endif

@if(session()->has('error'))

    <div class="alert alert-danger" style="width: 80%; margin:auto;">
        {{ session('error') }}
    </div>

@endif