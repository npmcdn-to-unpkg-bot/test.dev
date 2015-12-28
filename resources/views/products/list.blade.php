@extends('layouts.front')
@section('content')
<h4 class="text-info">List of products</h4>
@foreach($products as $product)
    <div class="col-xs-4">
        <p class="label label-success">{{$product->model}}</p>
        <ol class="list-inline">
            @foreach($product->seasons as $season)
                <li>{{$season->name}}</li>
                @endforeach
        </ol>
    </div>
    @endforeach
    @endsection