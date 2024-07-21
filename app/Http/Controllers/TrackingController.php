<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $tracking = Tracking::orderBy('created_at', 'desc')->paginate(10);

        return view('tracking.index', compact('tracking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tracking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'company' => 'required|string',
                'identification_number' => 'required|integer',
                'name' => 'required|string',
                'lastname' => 'required|string',
                'address' => 'required|string',
                'number_phone' => 'required|string',
                'shipping_characteristics' => 'required|string',
                'status' => 'required|string',
            ]);

            $tracking = new Tracking();
            $tracking->number_tracking = 'RAS-' . mt_rand(100000, 999999);
            $tracking->company = $request->get('company');
            $tracking->identification_number = $request->get('identification_number');
            $tracking->name = $request->get('name');
            $tracking->lastname = $request->get('lastname');
            $tracking->address = $request->get('address');
            $tracking->number_phone = $request->get('number_phone');
            $tracking->shipping_characteristics = $request->get('shipping_characteristics');
            $tracking->status = $request->get('status');

            if(!$tracking->save()) {
                Alert::error('Error de guardado', 'El rastreo no fue creado correctamente.');
                return redirect()->route('tracking.index');
            }

            Alert::success('Guardado exitoso', 'Rastreo creado correctamente.');
            return redirect()->route('tracking.index');
        }catch (Throwable $throwable) {
            dd($throwable);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $trackingId)
    {
        try {
            $tracking = Tracking::whereId($trackingId)->first();

            return view('tracking.show', compact('tracking'));
        }catch (Throwable $throwable) {
            dd($throwable);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $trackingId)
    {
        try {
            $tracking = Tracking::whereId($trackingId)->first();

            return view('tracking.edit', compact('tracking'));
        }catch (Throwable $throwable) {
            dd($throwable);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $trackingId)
    {
        try {
            $request->validate([
                'company' => 'required|string',
                'identification_number' => 'required|integer',
                'name' => 'required|string',
                'lastname' => 'required|string',
                'address' => 'required|string',
                'number_phone' => 'required|string',
                'shipping_characteristics' => 'required|string',
                'status' => 'required|string',
            ]);

            $trackingUpdate = Tracking::whereId($trackingId)->first();
            $trackingUpdate->company = $request->get('company');
            $trackingUpdate->identification_number = $request->get('identification_number');
            $trackingUpdate->name = $request->get('name');
            $trackingUpdate->lastname = $request->get('lastname');
            $trackingUpdate->address = $request->get('address');
            $trackingUpdate->number_phone = $request->get('number_phone');
            $trackingUpdate->shipping_characteristics = $request->get('shipping_characteristics');
            $trackingUpdate->status = $request->get('status');

            if(!$trackingUpdate->save()) {
                Alert::error('Error de guardado', 'El rastreo no fue actualizado correctamente.');
                return redirect()->route('tracking.index');
            }

            Alert::success('Guardado exitoso', 'Rastreo actualizado correctamente.');
            return redirect()->route('tracking.index');
        }catch (Throwable $throwable) {
            dd($throwable);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $trackingId)
    {
        try {
            $tracking = Tracking::findOrFail($trackingId);
            $tracking->delete();

            Alert::success('Eliminación exitosa', 'Rastreo eliminado correctamente.');

            return redirect()->route('tracking.index');
        }catch (Throwable $throwable){
            dd($throwable);
        }
    }
}
