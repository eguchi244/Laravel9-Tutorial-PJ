<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *  ホームページを表示する
     *  GET /
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var App\Models\User **/
        $user = Auth::user();

        $folder = $user->folders()->first();

        if (is_null($folder)) {
            return view('home');
        }

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}