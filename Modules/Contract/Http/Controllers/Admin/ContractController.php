<?php

namespace Modules\Contract\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Contract\Entities\Contract;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Category\Http\Requests\SaveContractRequest;

class ContractController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'contract::contracts.contract';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'contract::admin.contracts';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveContractRequest::class;

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('contract::contracts.contract.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\User\Http\Requests\UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(SaveContractRequest $request)
    {
        return back()->withSuccess(trans('contract::messages.contract_saved', [
            'resource' => trans('contract::contracts.contract'),
        ]));
    }

}
