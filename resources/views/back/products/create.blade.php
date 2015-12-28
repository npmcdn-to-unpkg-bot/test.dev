@extends('layouts.back')
@section('content')
    <div class="content-block">
        @include('back.menu')
        <div class="col-md-10">
            <h4> <u>Добавить изделие в каталог</u></h4>
            <form class="form-horizontal" action="{{route('api.products.store')}}" method="post" id="storeProduct">
                {{csrf_field()}}
                <div class="form-group-sm">
                    <label class="control-label">Модель</label>
                    <input type="text" class="form-control" name="model">
                </div>
                <div class="form-group-sm">
                    <label class="control-label">Артикул</label>
                    <input type="text" class="form-control" name="article">
                </div>
                <div class="form-group-sm">
                    <label class="control-label">Рост</label>
                    <input id="growth-range" type="text" name="growth" value="">
                </div>
                <div class="form-group-sm">
                    <label class="control-label">Размер</label>
                    <input id="size-range" type="text" name="size" value="">
                </div>
                <div class="form-group-sm">
                    <label class="control-label">Сезон</label>
                    <select id="select-season"  placeholder="Выберите сезон..." name="season[]" multiple>
                        @foreach($seasons as $season)
                            <option value="{{$season->id}}">{{$season->slug}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group-sm">
                    <label class="control-label">Категория</label>
                    <select id="select-category"  name="category[]" placeholder="Выберите категорию..." multiple>

                        @foreach($categories as $category)
                            @if($category->isRoot())
                                <optgroup label="{{$category->name_ru}}">
                                    @foreach($category->children as $child)
                                        <option value="{{$child->id}}">{{$child->name_ru}}</option>
                                    @endforeach
                                </optgroup>
                            @else
                                <option value="{{$category->id}}">{{$category->name_ru}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group-sm">
                    <label class="control-label">Материал</label>
                    <select id="select-material" placeholder="Выберите материал..." name="material[]" multiple>
                        @foreach($materials as $material)
                            <option value="{{$material->id}}">{{$material->name_ru}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group-sm">
                    <label class="control-label">Описание</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="form-group-sm col-md-4">
                    <label class="control-label">Новое изделие?</label>
                    <select id="select-new" name="new" placeholder="...">
                        <option value="1">Да</option>
                        <option value="0">Нет</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <div class="btn-group-sm pull-right">
                    <button type="reset" class="btn btn-warning">Сбросить</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection