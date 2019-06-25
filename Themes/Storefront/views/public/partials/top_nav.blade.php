<div class="top-nav">
    <div class="container">
        <div class="top-nav-wrapper clearfix">
            <div class="top-nav-left pull-left">
                <ul class="list-inline">
                    @if (count(setting('supported_currencies')) > 1)
                        <li>
                            <select class="top-nav-select custom-select-white form-control btn-success" onchange="location = this.value">
                                @foreach (setting('supported_currencies') as $currency)
                                    <option value="{{ route('current_currency.store', ['currency' => $currency]) }}" {{ currency() === $currency ? 'selected' : '' }}>
                                        {{ $currency }}
                                    </option>
                                @endforeach
                            </select>
                        </li>
                    @endif

                    @if (count(supported_locales()) > 1)
                        <li>
                            <select class="top-nav-select custom-select-white form-control btn-success" onchange="location = this.value">
                                @foreach (supported_locales() as $locale => $language)
                                    <option value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>
                                        {{ $language['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="top-nav-right pull-right">
                <ul class="list-inline">
                    <li><a href="{{ route('contact.create') }}">{{ trans('storefront::contact.contact') }}</a></li>

                    <li>
                        <a href="{{ route('compare.index') }}">
                            {{ trans('storefront::layout.compare') }} ({{ $compareCount }})
                        </a>
                    </li>

                    @auth
                        <li><a href="{{ route('account.wishlist.index') }}">{{ trans('storefront::account.links.my_wishlist') }}</a></li>

                        <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.links.my_account') }}</a></li>
                        <li><a href="{{ route('account.orders.index') }}">{{ trans('storefront::account.links.my_orders') }}</a></li>
                        @if (count(contracts()) > 1)
                            <li>
                                <select class="top-nav-select custom-select-white btn-danger form-control" onchange="sendData('/contract/'+this.value);">
                                    <option value=Null >
                                        {{ trans('storefront::contract.without_contract') }}
                                    </option>
                                    @foreach (contracts() as $contract)
                                        <option value="{{ $contract->id }}" {{ contract_current() == $contract->id ? 'selected' : '' }}>
                                            {{ $contract->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">{{ trans('storefront::layout.log_in') }}</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function sendData(url) {
        $.get(url, function(data){
            if (data[0] == 'Ok'){
                var result = confirm(data[2]);
                if (result) {
                    location.reload();
                } else {
                    $.get('/contract/' + data[1]);
                }
            } else {
                location.reload();
            }
            // location.reload();
        });
    }
</script>
