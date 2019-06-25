<div class="billing-address clearfix">
    <h5>{{ trans("storefront::checkout.tabs.billing_address") }}</h5>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('billing.first_name') ? 'has-error': '' }}">
            <label for="billing-first-name">
                {{ trans('storefront::checkout.tabs.attributes.billing.first_name') }}<span>*</span>
            </label>

            <input type="text" name="billing[first_name]" value="{{ $orderModel->billing_first_name ? $orderModel->billing_first_name : old('billing.first_name') }}" class="form-control" id="billing-first-name">

            {!! $errors->first('billing.first_name','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('billing.last_name') ? 'has-error': '' }}">
            <label for="billing-last-name">
                {{ trans('storefront::checkout.tabs.attributes.billing.last_name') }}<span>*</span>
            </label>

            <input type="text" name="billing[last_name]" value="{{ $orderModel->billing_last_name ? $orderModel->billing_last_name : old('billing.last_name') }}" class="form-control" id="billing-last-name">

            {!! $errors->first('billing.last_name','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('billing.address_1') ? 'has-error': '' }}">
            <label for="billing-1">
                {{ trans('storefront::checkout.tabs.attributes.billing.address_1') }}<span>*</span>
            </label>

            <input type="text" name="billing[address_1]" value="{{ $orderModel->billing_address_1 ? $orderModel->billing_address_1 : old('billing.address_1') }}" class="form-control" id="billing-address-1">

            {!! $errors->first('billing.address_1','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group {{ $errors->has('billing.address_2') ? 'has-error': '' }}">
            <label for="billing-2">
                {{ trans('storefront::checkout.tabs.attributes.billing.address_2') }}
            </label>

            <input type="text" name="billing[address_2]" value="{{ $orderModel->billing_address_2 ? $orderModel->billing_address_2 : old('billing.address_2') }}" class="form-control" id="billing-address-2">

            {!! $errors->first('billing.address_2','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('billing.city') ? 'has-error': '' }}">
            <label for="billing-city">
                {{ trans('storefront::checkout.tabs.attributes.billing.city') }}<span>*</span>
            </label>

            <input type="text" name="billing[city]" value="{{ $orderModel->billing_city ? $orderModel->billing_city : old('billing.city') }}" class="form-control" id="billing-city">

            {!! $errors->first('billing.city','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('billing.zip') ? 'has-error': '' }}">
            <label for="billing-zip">
                {{ trans('storefront::checkout.tabs.attributes.billing.zip') }}<span>*</span>
            </label>

            <input type="text" name="billing[zip]" value="{{ $orderModel->billing_zip ? $orderModel->billing_zip : old('billing.zip') }}" class="form-control" id="billing-zip">

            {!! $errors->first('billing.zip','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('billing.country') ? 'has-error': '' }}">
            <label for="billing-country">
                {{ trans('storefront::checkout.tabs.attributes.billing.country') }}<span>*</span>
            </label>

            <select name="billing[country]" class="custom-select-black" id="billing-country">
                @foreach ($countries as $code => $name)
                    <option value="{{ $code }}" {{ old('billing.country', $orderModel->billing_country ?? '') === $code ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('billing.country','<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('billing.state') ? 'has-error': '' }}">
            <label for="billing-state">
                {{ trans('storefront::checkout.tabs.attributes.billing.state') }}<span>*</span>
            </label>

            <input type="text" name="billing[state]" value="{{ $orderModel->billing_state ? $orderModel->billing_state : old('billing.state') }}" class="form-control" id="billing-state">

            {!! $errors->first('billing.state','<span class="error-message">:message</span>') !!}
        </div>
    </div>
</div>
