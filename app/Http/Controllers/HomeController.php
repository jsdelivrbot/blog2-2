<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([//transforma a lista abaixo em json para ser utilizada em js
            ["titulo"=>"Home", "url"=> ""],
        ]);
        return view('home', compact('listaMigalhas'));
    }
}
