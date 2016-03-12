<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 27.01.2016
 * Time: 13:38
 */

Breadcrumbs::register('home',function($breadcrumbs){
    $breadcrumbs->push('главная',url('/'),['']);
});

Breadcrumbs::register('about',function($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('о нас',url('/about'));
});

Breadcrumbs::register('catalog',function($breadcrumbs){

    $breadcrumbs->parent('home');
    $breadcrumbs->push('каталог',url('/catalog'));
});

Breadcrumbs::register('category',function($breadcrumbs,$category){

    if($category->isRoot()) {
        $breadcrumbs->parent('catalog');
        $breadcrumbs->push($category->name_ru, URL::action('CatalogController@category', ['category' => $category->name]));
    }
    else {
        $breadcrumbs->parent('catalog');
        $breadcrumbs->push($category->parent->name_ru, URL::action('CatalogController@category', ['category' => $category->parent->name]));
        $breadcrumbs->push($category->name_ru, URL::action('CatalogController@category', [
            'category' => $category->name,
        ]));
    }
}
);

Breadcrumbs::register('news',function($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('новости',url('/news'));
});

Breadcrumbs::register('contacts',function($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('контакты',url('/contacts'));
});