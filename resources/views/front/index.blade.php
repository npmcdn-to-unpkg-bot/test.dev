@extends('layouts.front')
@section('content')
    <div class="gallery">
        <div class="gallery-cell">
            <img src="{{asset('/images/slider/linen.jpg')}}"/>
            <div class="caption">Одежда изо льна&nbsp;
                <svg width="32" height="32">
                    <use xlink:href="#dress" style="fill: cornflowerblue"></use>
                </svg>
            </div>
        </div>
        <div class="gallery-cell">
            <img src="{{asset('/images/slider/9.jpg')}}"/>
            <div class="caption">
                Доставка либо самовывоз&nbsp;
                <svg width="32" height="32">
                    <use xlink:href="#shipping"></use>
                </svg>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row info-block">
            <div class="info-block-item">
                <p>Ассортимент постоянно пополняется новыми моделями</p>
                <svg class="icon" width="40" height="40">
                    <use xlink:href="#models"></use>
                </svg>
            </div>
            <div class="info-block-item">
                <p>Работаем с сырьем заказчика, производим пошив спецодежды(халаты и др.)</p>
                <svg class="icon" width="40" height="40">
                    <use xlink:href="#sewing-machine"></use>
                </svg>
            </div>
            <div class="info-block-item">
                <p>Сотрудничаем с торговыми объектами страны, а также юридическими лицами</p>
                <svg class="icon" width="40" height="40">
                    <use xlink:href="#customers"></use>
                </svg>
            </div>
        </div>
    </div>
@endsection