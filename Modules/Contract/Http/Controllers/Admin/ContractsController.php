<?php

namespace Modules\Contract\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Contract\Entities\Contract;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Contract\Http\Requests\SaveContractRequest;

class ContractsController extends Controller
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

}
