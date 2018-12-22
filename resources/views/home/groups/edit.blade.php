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
                <div class="card-header bg-info">Редактирование группы <b>{{$group->year%100}}{{$group->specialties->short_name}}-{{$group->number}}</b></div>
                <div class="card-body">
                    <form action="{{route('apply_edit_group', $group->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Номер группы</span>
                            </div>
                            <input type="text" name="number" class="form-control" placeholder="Номер группы" value="{{$group->number}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Год поступления</span>
                            </div>
                            <input type="text" name="year" class="form-control" placeholder="Год поступления" value="{{$group->year}}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Специальность</span>
                            </div>
                            <select name="specialty" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($spec as $item)
                                @if(!is_null($group->specialties))
                                    @if($item->id == $group->specialties->id)
                                        <option value="{{$item->id}}" class="form-control" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                    @endif
                                @else
                                    <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                @endif    
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Отделение</span>
                            </div>
                            <select name="department" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($dep as $item)
                                @if(!is_null($group->departments))
                                    @if($item->id == $group->departments->id)
                                        <option value="{{$item->id}}" class="form-control" selected>{{$item->name}}</option>
                                    @else
                                        <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                    @endif
                                @else
                                    <option value="{{$item->id}}" class="form-control">{{$item->name}}</option>
                                @endif    
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Приказ о зачислении</span>
                            </div>
                            <select name="order" class="form-control">
                                <option value="">Не выбрано</option>
                                @foreach($order as $item)
                                @if(!is_null($group->order_id))
                                    @if($item->id == $group->orders->id)
                                        <option value="{{$item->id}}" class="form-control" selected>{{$item->number}} от {{\Carbon\Carbon::parse($item->date)->format('d.m.Y')}}</option>
                                    @else
                                        <option value="{{$item->id}}" class="form-control">{{$item->number}} от {{\Carbon\Carbon::parse($item->date)->format('d.m.Y')}}</option>
                                    @endif
                                @else
                                    <option value="{{$item->id}}" class="form-control">{{$item->number}} от {{\Carbon\Carbon::parse($item->date)->format('d.m.Y')}}</option>
                                @endif    
                                    @endforeach
                            </select>
                        </div>

                        <input type="submit" class="btn btn-block btn-success" value="Применить изменения">
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
</div>
@endsection
