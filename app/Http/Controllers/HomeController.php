<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{

    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /**
         * @var $user User
         */
        $user = Auth::user();

        if ($user) {
            $name = $user->name;
        } else {
            $name = "Guest";
        }


        return view(
            'pages.home', [
                            'name' => $name,
                        ]
        );
    }

    public function about(): View
    {
        return view('pages.about',);
    }

}
