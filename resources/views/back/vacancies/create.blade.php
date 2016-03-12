@extends('layouts.back')
@section('content')

    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
            <h4>Новая вакансия</h4>
        </div>
        <div class="col-md-6 col-md-offset-1">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{Form::open(array('url'=>'/dashboard/vacancies/store','method'=>'post','class'=>'form-horizontal','id'=>'storeVacancy'))}}
            <div class="form-group-sm col-md-4">
                {{Form::label('position','Вакансия',['class'=>'control-label'])}}
                {{Form::text('position',null,array('class'=>'form-control'))}}
            </div>
            <div class="form-group-sm col-md-4">
                {{Form::label('salary','Оклад',['class'=>'control-label'])}}
                {{Form::text('salary',null,array('class'=>'form-control'))}}
            </div>
            <div class="form-group-sm col-md-4">
                {{Form::label('position','Горящая вакансия',['class'=>'control-label'])}}
                {{Form::select('hot',['0'=>'Нет','1'=>'Да'],0,['class'=>'form-control'])}}
            </div>
            <div class="form-group-sm">
                {{Form::label('description','Требования/Описание',['class'=>'control-label'])}}
                {{Form::textarea('description',null,array('class'=>'form-control'))}}
            </div>
            <duv class="form-group">
                {{Form::submit('Сохранить',['class'=>'btn btn-sm btn-primary'])}}
            </duv>
            {{Form::close()}}

        </div>
    </div>
@endsection