<div class="col-md-12 col-xs-12">
    <div class="row catalog-gallery">
        @forelse($products as $product)
            <div class="col-md-4 col-xs-6 catalog-item text-center">
                <a class="img-thumbnail image-popup" title="Модель&nbsp;&nbsp;{{$product->model}}" href="/uploads/{{$product->model}}/{{$product->photo}}">
                    <img src="/img/{{$product->model}}/large/{{$product->photo}}" class="img-responsive"/>
                    @if($product->isNew())
                        <svg class="new" width="28" height="28" style="fill: #567eff">
                            <use xlink:href="#new"></use>
                        </svg>
                    @else
                    @endif
                </a>
                <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-1">
                    <span class="label product-label">{{$product->model}}</span>
                    <span class="text-muted pull-right">
                            <small>р.&nbsp;{{$product->size}}</small>
                            </span>
                </div>
            </div>
        @empty($products)
            <div class="col-md-10 text-center">
                <span class="help-block">Здесь пока пусто...</span>
            </div>
        @endforelse
    </div>
    <div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
        {!! $products->appends(request()->except(['page']))->render() !!}
    </div>
</div>