<?php

namespace App\Http\Controllers;

use App\Filters\HomeFilter;
use App\Models\Home;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @author Aushev Ibra <aushevibra@yandex.ru>
 */
class HomeController extends Controller
{

    /**
     * @param Request $request
     * @return \int[][]
     * @author Aushev Ibra <aushevibra@yandex.ru>
     */
    public function index(Request $request, HomeFilter $filter)
    {
        $data = Home::query()->filter($filter)->get();

        return $data;
    }
}
