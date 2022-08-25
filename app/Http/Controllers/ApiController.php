<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $apiService;
    public function __construct(ApiService $apiservice)
    {
        $this->apiService = $apiservice;
    }

    public function index(Request $request)
    {
        $city = $request->input('searchInput');
        $api_key = $this->apiService->getCityByName($city);
        return view('home', ['key' => $api_key]);
    }
}