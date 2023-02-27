<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

/**
 * Registration of new user
 */
class RegisterController extends Controller
{

    /**
     * Full pape with registration form
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function form(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.reg');
    }

    /**
     * Submit data from registration form
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request): \Illuminate\Http\JsonResponse
    {
        $answer = RegisterService::register($request);

        return response()->json($answer[0], $answer[1]);
    }

}
