@extends('layouts.front')
@section('content')
    <div class="row">
        {!! Breadcrumbs::render('contacts') !!}
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <aside>
                <div class="header bg-primary">
                    <h5>Контакты</h5>
                </div>
                <nav id="menu" class="metismenu">
                    <ul class="nav nav-stacked">
                        <li>{{link_to('/contacts','Телефоны')}}</li>
                        <li>{{link_to('/contacts/mail','Обратная связь')}}</li>
                    </ul>
                </nav>
            </aside>
        </div>
        <div class="col-md-9 col-xs-12">
            @yield('subcontent')
        </div>
    </div>
@endsection