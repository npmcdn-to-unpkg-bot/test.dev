@extends('layouts.front')
@section('content')
    <div class="row">
        @if($category)
            {!! Breadcrumbs::render('category',$category) !!}
        @else
            {!! Breadcrumbs::render('catalog') !!}
        @endif
        <div class="col-md-3 col-xs-12">
            <aside>
                <div class="header bg-primary">
                    <h5>Каталог&nbsp;<i class="fa fa-bars pull-right"></i></h5>
                </div>
                <nav id="menu" class="metismenu">
                    {!! Html::nav($categories,'catalog') !!}
                </nav>
            </aside>
            <div class="col-md-12 col-xs-12 filtrate">
                <h5><u>Подобрать</u><i class="fa fa-filter pull-right"></i></h5>
                <form role="form">
                    <input type="hidden" id="select-category" name="category" value="{{$category->id or null}}">
                    <div class="filtrate-block-item">
                        <div class="checkbox">
                            <input type="checkbox" class="styled" id="only-new" name="new" {{App\Helpers\Helper::hasParam(request()->query('new'),1)}} value="1">
                            <label>Новинки</label>
                        </div>
                    </div>
                    <div class="filtrate-block-item">
                        <span class="text-muted"><u>Сезон</u></span>
                        @foreach($seasons as $season)
                            <div class="checkbox">
                                <input type="checkbox" class="select-season styled" name="season[]" value="{{$season->id}}" {{App\Helpers\Helper::hasParam(request()->query('season'),$season->id)}}>
                                <label>{{\Illuminate\Support\Str::ucfirst($season->slug)}}</label>
                            </div>
                        @endforeach
                    </div>
                        <button type="submit" rel="{{Request::url()}}" class="btn btn-sm btn-block btn-filter">Показать</button>

                </form>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="col-md-12  col-xs-12" id="filter-block">
          {{--      <div class="col-md-3 pull-right text-right">
                    <span style="float: left; padding: 0 5px;">На страницу:</span>
                    <ol class="list-inline" style="float: left; padding: 0 5px;">
                        <li><a href="{{Html::modify_url(['on'=>12])}}">12</a></li>
                        <li><a href="{{Html::modify_url(['on'=>24])}}">24</a></li>
                        <li><a href="{{Html::modify_url(['on'=>48])}}">48</a></li>
                    </ol>
                </div>--}}
                <form class="form-inline">
                    <div class="col-md-9">
                        Сортировать по:
                        {{--<a href="{{Html::modify_url(['sort'=>'created_at','order'=>'asc'])}}" class="link-filter sort-date" data-field="created_at">дате--}}
                        {{link_to(request()->fullUrlWithQuery(['sort'=>'created_at','order'=>'asc']),'дате',['class'=>'link-filter sort-date','data-field'=>'created_at'])}}
                        {{link_to(request()->fullUrlWithQuery(['sort'=>'model','order'=>'asc']),'модели',['class'=>'link-filter sort-model','data-field'=>'model'])}}
                    </div>
                </form>
            </div>
            @include('front.partials.products')
        </div>
    </div>
@endsection