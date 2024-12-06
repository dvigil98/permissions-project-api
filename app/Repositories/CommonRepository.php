<?php

namespace App\Repositories;

use App\Interfaces\ICommonRepository;
use Illuminate\Support\Facades\DB;

class CommonRepository implements ICommonRepository
{
    public function getModules()
    {
        $modules = DB::table('permissions')
            ->select('module as name')
            ->orderBy('module', 'asc')
            ->groupBy('module')
            ->get();

        return $modules;
    }
}
