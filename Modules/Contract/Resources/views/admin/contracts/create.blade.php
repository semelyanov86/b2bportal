@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('admin::resource.create', ['resource' => trans('contract::contracts.contract')]))

    <li><a href="{{ route('admin.contracts.index') }}">{{ trans('contract::contracts.contracts') }}</a></li>
    <li class="active">{{ trans('admin::resource.create', ['resource' => trans('contract::contracts.contract')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.contracts.store') }}" class="form-horizontal" id="contract-create-form" novalidate>
        {{ csrf_field() }}
        <div class="col-sm-8">
            {{ Form::text('name', trans('contract::attributes.name'), $errors, $contract, ['required' => true]) }}
        </div>
        <button class="btn btn-primary" type="submit" data-loading>
            {{ trans('contract::attributes.save') }}
        </button>

    </form>
@endsection

@include('contract::admin.contracts.partials.shortcuts')
