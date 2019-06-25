<div class="row">
<div class="product-card-list clearfix col-sm-8">
    <a class="product-image pull-left" href="{{ route('products.show', $product->slug) }}">
        <ul class="product-ribbon list-inline">
            @if ($product->isOutOfStock())
                <li><span class="ribbon bg-red">{{ trans('storefront::product_card.out_of_stock') }}</span></li>
            @endif
        </ul>

        @if (! $product->base_image->exists)
            <div class="image-placeholder">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
            </div>
        @else
            <div class="image-holder">
                <img src="{{ $product->base_image->path }}">
            </div>
        @endif
    </a>
    <div class="product-content clearfix">
        <div class="product-content-inner">
            <a href="{{ route('products.show', $product->slug) }}" class="product-name">
                <h5>{{ $product->name }}</h5>
            </a>

            <span class="product-price">{{ product_price($product) }}</span>

            <p>{{ $product->short_description }}</p>
        </div>
        <div class="hidden-sm hidden-md hidden-lg">
            @include('public.products.partials.product.stockinfo')
        </div>

        <div class="product-card-buttons">
            <form method="POST" action="{{ route('wishlist.store') }}">
                {{ csrf_field() }}

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <button type="submit" data-toggle="tooltip" data-placement="top" title="{{ trans('storefront::product_card.add_to_wishlist') }}" class="btn btn-wishlist">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
            </form>

            <form method="POST" action="{{ route('compare.store') }}">
                {{ csrf_field() }}

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <button type="submit" data-toggle="tooltip" data-placement="top" title="{{ trans('storefront::product_card.add_to_compare') }}" class="btn btn-compare">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </button>
            </form>

            @if ($product->options_count > 1)
                <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="btn btn-primary">
                    {{ trans('storefront::product_card.view_details') }}
                </a>
            @else
                <form method="POST" action="{{ route('cart.items.store') }}" class="form-inline">
                    {{ csrf_field() }}

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="quantity pull-left clearfix">
                                <div class="input-group-quantity pull-left clearfix">
                                    <input type="text" name="qty" value="1" class="input-number input-quantity pull-left" style="width: 70px;" min="1">

                                    <span class="pull-left btn-wrapper">
                                                                <button type="button" class="btn btn-number btn-plus" data-type="plus"> + </button>
                                                                <button type="button" class="btn btn-number btn-minus" data-type="minus"> &#8211; </button>
                                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <button type="submit" class="add-to-cart btn btn-primary" {{ $product->isOutOfStock() ? 'disabled' : '' }} data-loading>
                                {{ trans('storefront::product_card.add_to_cart') }}
                            </button>
                        </div>

                    </div>

                </form>
            @endif
        </div>
    </div>
</div>
    <div class="col-sm-4 m-t-10 hidden-xs">
        {{--@if ($product->isOutOfStock())
            <li><span class="ribbon bg-red">{{ trans('storefront::product_card.out_of_stock') }}</span></li>
        @endif--}}
        @include('public.products.partials.product.stockinfo')
    </div>
</div>