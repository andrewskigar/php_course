<?php

namespace App\Http\Controllers;

use App\Services\TextStatistics;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TextStatisticsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('form', [
            'text' => '',
        ]);
    }

    public function stats(Request $request, TextStatistics $textStats)
    {
        $textStats->calculate($request->get('text'));

        return view('form', [
            'text' => $request->get('text'),
            'textStats' => $textStats,
        ]);
    }
}
