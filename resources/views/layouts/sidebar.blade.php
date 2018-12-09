
@section('sidebar')
    <div class="col-3">
        <div class="list-group">
            <a href="{{route('statements')}}" class="list-group-item list-group-item-action">Заявления</a>
            <a href="{{route('students')}}" class="list-group-item list-group-item-action">Студенты</a>
            <a href="{{route('groups')}}" class="list-group-item list-group-item-action">Группы</a>
            <a href="{{route('orders')}}" class="list-group-item list-group-item-action">Приказы</a>
            <a href="{{route('departments')}}" class="list-group-item list-group-item-action">Отделения</a>
            <a href="{{route('specialties')}}" class="list-group-item list-group-item-action">Специальности</a>
            <a href="{{route('type_spravki')}}" class="list-group-item list-group-item-action">Типы справок</a>
            <a href="{{route('users')}}" class="list-group-item list-group-item-action">Пользователи</a>
        </div>
    </div>
@endsection
