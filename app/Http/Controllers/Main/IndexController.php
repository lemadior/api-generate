<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class IndexController extends Controller
{
    /**
     * @return View|Factory|Application|ContractsApplication
     */
    public function __invoke(): View | Factory | Application | ContractsApplication
    {
        return view('main.index');
    }
}
