<?php

namespace App\Services;

use App\Interfaces\ICommonRepository;
use App\Interfaces\ICommonService;
use App\Traits\ApiResponse;

class CommonService implements ICommonService
{
    use ApiResponse;

    private $commonRepository;

    public function __construct(ICommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository;
    }

    public function getModules()
    {
        try {
            $modules = $this->commonRepository->getModules();

            return $this->ok($modules);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }
}
