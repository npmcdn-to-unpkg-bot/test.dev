@extends('layouts.back')
@section('content')
    <div class="content-block">
        @include('back.menu')
    <div class="row">
        <div class="col-xs-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Изделий в каталоге</div>
                <div class="panel-body">
                    Всего:&nbsp;{{$count}}
                </div>
            </div>
        </div>
    </div>
    </div>
    @endsection