<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Throwable;

class DetailTrackingController extends Controller
{
    public function index(string $numberTracking)
    {
        try {
            $trackingDetail = Tracking::whereNumberTracking($numberTracking)->first();

            return view('tracking.detail.index', compact('trackingDetail'));
        }catch (Throwable $throwable){
            dd($throwable);
        }
    }
}
