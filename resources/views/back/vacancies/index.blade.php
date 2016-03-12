@extends('layouts.back')
@section('content')

    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
          {{link_to_route('vacancies.create','Добавить вакансию',[],['class'=>'btn btn-sm btn-primary pull-right'])}}
        </div>
        <div class="col-md-10">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Вакансия</th>
                    <th>Описание</th>
                    <th>Оклад</th>
                    <th>Горящая</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($vacancies as $vacancy)
                     <tr>
                         <td>{{$vacancy->id}}</td>
                         <td>{{$vacancy->position}}</td>
                         <td>{{$vacancy->description}}</td>
                         <td>{{$vacancy->salary}}</td>
                     </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endsection