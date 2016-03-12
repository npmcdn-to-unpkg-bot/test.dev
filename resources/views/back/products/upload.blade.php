@extends('layouts.back')
@section('content')
    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
            {!! Form::model($product) !!}
            {!! Form::hidden('id',$product->id) !!}
            <div class="form-group">
                <h4>Загрузка фото модели&nbsp;{{$product->model}}</h4>
            <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Выберите файлы...</span>
        <input type="file" id="fileupload" data-url="/dashboard/image/upload" name="files" multiple>
    </span>
            </div>
            <div id="progress" class="progress">
                <div class="progress-bar progress-bar-success"></div>
            </div>
            <div class="form-group">
                <div id="files" class="files"></div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection