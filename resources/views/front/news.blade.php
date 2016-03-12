@extends('layouts.front')
@section('content')
{!! Breadcrumbs::render('news') !!}
<div class="col-md-3 col-xs-12">
    <aside>
        <div class="header bg-primary">
            <h5>Новости&nbsp;<i class="fa fa-newspaper-o pull-right"></i></h5>
        </div>
        <nav id="menu" class="metismenu">

        </nav>
    </aside>
</div>
@endsection