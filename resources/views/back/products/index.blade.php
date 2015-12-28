@extends('layouts.back')
@section('content')
    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
            <a href="{{route('product.create')}}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Новое изделие</a>
        </div>
        <div class="col-md-10 prod-records">
            <table id="records-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Модель</th>
                    <th>Артикул</th>
                    <th>Опубликована</th>
                    <th>Новинка</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection