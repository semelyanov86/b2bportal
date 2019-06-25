<div class="shipping-address clearfix {{ old('ship_to_a_different_address') ? '' : 'hide' }}">
    <h5>{{ trans("storefront::checkout.tabs.shipping_address") }}</h5>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-first-name">
                {{ trans('storefront::checkout.tabs.attributes.shipping.first_name') }}<span>*</span>
            </label>

            <input type="text" name="shipping[first_name]" value="{{ $orderModel->shipping_first_name ? $orderModel->shipping_first_name : old('shipping.first_name') }}" class="form-control" id="shipping-first-name">

            {!! $errors->first('shipping.first_name','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-last-name">
                {{ trans('storefront::checkout.tabs.attributes.shipping.last_name') }}<span>*</span>
            </label>

            <input type="text" name="shipping[last_name]" value="{{ $orderModel->shipping_last_name ? $orderModel->shipping_last_name : old('shipping.last_name') }}" class="form-control" id="shipping-last-name">

            {!! $errors->first('shipping.last_name','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-1">
                {{ trans('storefront::checkout.tabs.attributes.shipping.address_1') }}<span>*</span>
            </label>

            <input type="text" name="shipping[address_1]" value="{{ $orderModel->shipping_address_1 ? $orderModel->shipping_address_1 : old('shipping.address_1') }}" class="form-control" id="shipping-address-1">

            {!! $errors->first('shipping.address_1','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-2">
                {{ trans('storefront::checkout.tabs.attributes.shipping.address_2') }}
            </label>

            <input type="text" name="shipping[address_2]" value="{{ $orderModel->shipping_address_2 ? $orderModel->shipping_address_2 : old('shipping.address_2') }}" class="form-control" id="shipping-address-2">

            {!! $errors->first('shipping.address_2','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-city">
                {{ trans('storefront::checkout.tabs.attributes.shipping.city') }}<span>*</span>
            </label>

            <input type="text" name="shipping[city]" value="{{ $orderModel->shipping_city ? $orderModel->shipping_city : old('shipping.city') }}" class="form-control" id="shipping-city">

            {!! $errors->first('shipping.city','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-zip">
                {{ trans('storefront::checkout.tabs.attributes.shipping.zip') }}<span>*</span>
            </label>

            <input type="text" name="shipping[zip]" value="{{ $orderModel->shipping_zip ? $orderModel->shipping_zip : old('shipping.zip') }}" class="form-control" id="shipping-zip">

            {!! $errors->first('shipping.zip','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-country">
                {{ trans('storefront::checkout.tabs.attributes.shipping.country') }}<span>*</span>
            </label>

            <select name="shipping[country]" class="custom-select-black" id="shipping-country">
                @foreach ($countries as $code => $name)
                    <option value="{{ $code }}" {{ old('shipping.country', $orderModel->shipping_country ?? '') === $code ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('shipping.country','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('shipping.first_name') ? 'has-error': '' }}">
            <label for="shipping-state">
                {{ trans('storefront::checkout.tabs.attributes.shipping.state') }}<span>*</span>
            </label>

            <input type="text" name="shipping[state]" value="{{ $orderModel->shipping_state ? $orderModel->shipping_state : old('shipping.state') }}{{ old('shipping.state') }}" class="form-control" id="shipping-state">

            {!! $errors->first('shipping.state','<span class="error-message">:message</span>') !!}
        </div>
    </div>
</div>
