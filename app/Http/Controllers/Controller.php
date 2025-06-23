<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use App\Models\Permission;
use App\Traits\HasMessage;
use App\Traits\viewHelper;
use App\Traits\apiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\serviceHelper;
use App\Helper\CustomMessages;
use App\Helper\CustomVariables;
use App\Events\CacheInvalidated;
use App\Traits\configFileHandler;
use App\Traits\HasCustomVariables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

abstract class Controller
{
    /* Using Traits */
    use
        apiResponse,
        serviceHelper,
        configFileHandler,
        viewHelper;

    protected $service;
    protected CustomVariables $customVariables;
    protected CustomMessages $customMessages;
    public $bladeFolder;
    protected $bladeFile;
    protected $bladePath;
    protected $requestModel;
    protected $requestName;
    protected $indexRoute;
    protected $adminPage;
    protected $ddlModel;
    protected $confService;
    protected $relModels;
    protected $dropDownData;
    protected array $searchFields = [];
    protected ?string $notificationClass = null;


    protected string $model;

    public function __construct(
        $service,
        bool $isAdminPage = false,
        array $dropDownData = [],
        array $getRelModels = [],
        array $searchFields = [],
    ) {
        $this->customVariables = app(CustomVariables::class);
        $this->customMessages = app(CustomMessages::class);
        $this->service = $service;
        $this->adminPage = $isAdminPage;
        $this->dropDownData = $dropDownData ?? [];
        $this->bladeFolder = $isAdminPage ? $this->customVariables->ADMIN : class_basename($this->service);
        $this->relModels = $getRelModels;
        $this->searchFields = $searchFields ?? [];
    }

    /**
     * Index method with caching
     */
    public function index()
    {
        // Gate::authorize('view', $this->model);
        $cacheKey = $this->getClassBaseName($this->service) . '_index_data';

        // Cache the data for 60 minutes (adjust as necessary)
        $viewData = Cache::remember($cacheKey, 60, function () {
            $data = [];
            $serviceName = strtolower(class_basename($this->service));
            $data[$serviceName] = $this->service->all($this->relModels);
            // dd($data[$serviceName]);

            // Dynamically resolve dropdowns from string keys
            if (!empty($this->dropDownData)) {
                foreach ($this->dropDownData as $modelKey) {
                    $modelClass = $this->resolveModelClass($modelKey);
                    if ($modelClass && class_exists($modelClass)) {
                        $data[$modelKey . 'Dropdown'] = $this->getDataByModel($modelClass);
                    }
                }
            }

            return $data;
        });
        //  dd($viewData);

        // Handle search from the already-loaded collection
        if (request()->filled('search')) {
            $searchTerm = request('search');
            $serviceName = strtolower(class_basename($this->service));
            $collection = $viewData[$serviceName];
            // Call a dynamic filter method
            $viewData[$serviceName] = $this->filterCollection($collection, $searchTerm);
        }
        return view($this->getBladePath(), $viewData);
    }

    public function create()
    {
        // dd('Create method called');
        $data = [];
        // Gate::authorize('create', $this->model);
        if (!empty($this->dropDownData)) {
                $data = $this->buildDropdownData($this->dropDownData);
            }

        return view($this->getBladePath(), $data);

    }

    /**
     * Store method with cache invalidation
     */
    public function store(Request $request)
    {

        try {
            // dd($request->all());

            $data = $this->getValidatedData($request);
            // dd($data);

            $resource = $this->createResource($data);
            dd($resource);

            if (!$resource) {
                abort(500, $this->customMessages->getMessage($this->customVariables->ACT_FAIL));
            }

            if ($this->shouldHandleConfigFile()) {
                $this->handleConfigFile($data);
            }

            if (method_exists($this, 'afterStore')) {
                $this->afterStore($resource);
            }

            $this->invalidateCache();

            return $this->generateResponse($resource->toArray());

        }  catch (\Exception $e) {

            return response()->view('errors.500', [
                'message' => $this->customMessages->getMessage($this->customVariables->TRY_AGAIN)
            ], 500);
        }
    }
    public function edit($id)
    {
        $data = $this->service->findById($id);
        $viewData = ['data' => $data];
        if (!empty($this->dropDownData)) {
                $viewData += $this->buildDropdownData($this->dropDownData);
            }
        return view($this->getBladePath(),$viewData);
    }

    public function show($id)
    {
        // dd($id);
        // dd($this->relModels);
        // Pass the relations dynamically
        $data = $this->service->findById($id, $this->relModels);
        // dd($data);

        return view($this->getBladePath(), compact('data'));
    }

    /**
     * Update method with cache invalidation
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $this->getValidatedData($request);

            $updatedData = $this->updateResource($id, $data);

            if (!$updatedData) {
                abort(500, $this->customMessages->getMessage($this->customVariables->ACT_FAIL));
            }

            $this->invalidateCache();

            return $this->generateResponse($updatedData->toArray());

        }  catch (\Exception $e) {
        abort(500, $this->customMessages->getMessage($this->customVariables->TRY_AGAIN));
    }
    }


    /**
     * Destroy method with cache invalidation
     */
    public function destroy($id, $key = null)
    {
        try {
            $this->destroyResource($id);

            if ($key) {
                $this->removeConfigFileKey($key);
            }

            $this->invalidateCache();

            return $this->generateResponse([], 200);

        } catch (\Exception $e) {

            return response()->view('errors.500', [
                'message' => $this->customMessages->getMessage($this->customVariables->TRY_AGAIN)
            ], 500);
        }
    }

    /**
     * Invalidate cache method
     */
    protected function invalidateCache()
    {
        event(new CacheInvalidated($this->getClassBaseName($this->service)));
    }

}
