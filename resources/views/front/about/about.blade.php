@extends('layouts.front')
@section('content')
    {!! Breadcrumbs::render('about') !!}
    <div class="col-md-3 col-xs-12">
        <aside>
            <div class="header bg-primary">
                <h5>О нас</h5>
            </div>
            <nav id="menu" class="metismenu">
                <ul class="nav nav-stacked">
                    <li>{{link_to('/about','О предприятии')}}</li>
                    <li>{{link_to('/about/awards','Награды')}}</li>
                    <li>{{link_to('/about/vacancies','Вакансии')}}</li>
                </ul>
            </nav>
        </aside>
    </div>
    <div class="col-md-9 col-xs-12">
        @yield('subcontent')
    </div>
@endsection