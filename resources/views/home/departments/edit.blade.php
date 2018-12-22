@extends('layouts.app')
@extends('layouts.sidebar')

@yield('layouts.sidebar')
{{-- @include('layouts.sidebar') --}}
@section('main')
<div class="col-9">
    {{-- Начало блока ошибок --}}
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    @endif

    @if(\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show p-4" role="alert">
        {!! session('success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    {{-- Конец блока ошибок --}}

    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-12"> --}}
            <div class="card">
                <div class="card-header bg-info">Редактирование отделения</div>
                <div class="card-body">
                    <form action="{{route('apply_edit_dep', $dep->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Наименование</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Наименование" value="{{$dep->name}}">
                        </div>

                        <input type="submit" class="btn btn-block btn-success" value="Применить изменения">
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
</div>
@endsection
