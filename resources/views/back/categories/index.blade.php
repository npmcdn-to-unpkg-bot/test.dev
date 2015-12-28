@extends('layouts.back')
@section('content')
    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
             <h4>Категория</h4>
            <button type="button"  data-toggle="modal" data-target="#createCategory" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Создать/Добавить</button>
        </div>
        <div class="col-md-10 tree-block">
            <div id="tree"></div>
        </div>
    </div>
    <div class="col-md-10">
       @include('back.categories.create')
    </div>
@endsection