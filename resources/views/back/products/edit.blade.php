@extends('layouts.back')
@section('content')
    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
            <h4> <u>Редактирование модели&nbsp;{{$product->model}}</u></h4>
            <div class="col-md-8">
                {{Form::model($product,array('route'=>['api.products.update',$product->id],'method'=>'PUT','id'=>'editProduct','class'=>'form-horizontal'))}}
                <div class="form-group-sm">
                    {{Form::label('model','Модель:')}}
                    {{Form::text('model',null,array('class'=>'form-control'))}}
                </div>
                <div class="form-group-sm">
                    {{Form::label('article','Артикул:')}}
                    {{Form::text('article',null,array('class'=>'form-control'))}}
                </div>
                <div class="form-group-sm">
                    {{Form::label('growth','Рост:')}}
                    {{Form::text('growth',null,array('class'=>'form-control','id'=>'growth-range'))}}
                </div>
                <div class="form-group-sm">
                    {{Form::label('size','Размер:')}}
                    {!!Form::text('size',null,array('class'=>'form-control','id'=>'size-range'))!!}
                </div>
                <div class="form-group-sm">
                    {!!Form::label('season_list','Сезон:')!!}
                    {!!Form::select('season_list[]',$seasons,null,['id'=>'select-season','class'=>'form-control','multiple'])!!}
                </div>
                <div class="form-group-sm">
                    {!! Form::label('material_list','Материал:') !!}
                    {!! Form::select('material_list[]',$materials,null,['id'=>'select-material','class'=>'form-control','multiple']) !!}
                </div>
                <div class="form-group-sm">
                    {!! Form::label('category_id','Категория:') !!}
                    {!! Form::select('category_id',$categories,$product->category_id,['id'=>'select-category','class'=>'form-control']) !!}
                </div>
                <div class="form-group-sm">
                    {!! Form::label('description','Описание:') !!}
                    {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group"></div>
                <div class="form-group-sm">
                    {!! Form::button('<i class="fa fa-pencil"></i>&nbsp;Обновить',['type'=>'submit','class'=>'btn btn-primary']) !!}
                </div>
                {{Form::close()}}
            </div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <h5>Изображения:</h5>
                    <a href="#" class="btn btn-sm btn-info btn-rounded btn-block"><i class="fa fa-upload"></i>&nbsp;Добавить изображения</a>
                </div>
                @foreach($product->images() as $image)
                    <div class="col-md-6 img-item">
                        <img class="photo {{$product->photo===$image?"base-photo":""}}" src="/img/{{$product->model}}/small/{{$image}}"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection