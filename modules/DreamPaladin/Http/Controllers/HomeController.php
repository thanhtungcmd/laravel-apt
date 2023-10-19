<?php

namespace Modules\DreamPaladin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use modules\DreamPaladin\Domain\DTO\Simple;
use Spatie\RouteDiscovery\Attributes\Route;
use Illuminate\Routing\Controller;

#[Route(uri: 'home')]
class HomeController extends Controller
{

    #[Route(method: 'get', uri: 'index')]
    public function index(Request $request) {
        $data = [
            'name' => 'hello',
            'record_company' => 'test'
        ];
        $simple = Simple::from($data);
        return $simple;
    }

    #[Route(method: 'get', uri: 'hello')]
    public function hello(Request $request) {
        App::setLocale("en");
        return view('dreampaladin::home');
    }

}
