<?php

namespace Modules\DreamPaladin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
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
        Log::channel(module_name_lower())->info($simple);
        return $simple;
    }

    #[Route(method: 'get', uri: 'hello')]
    public function hello(Request $request) {
        App::setLocale("vi");
        return view('dreampaladin::home');
    }

}
