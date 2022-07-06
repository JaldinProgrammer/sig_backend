<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function index(){
        return view('vehiculos.index');
    }
    public function show($id){
        try {
            $data = Vehicle::find($id);
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }



    public function all(){
        try {
//            $data=DB::table('vehicles')
//            ->join('drivers','drivers.vehicle_id', '<>', 'vehicles.id')
//            ->where('vehicles.tken','=',0)
//            ->select('vehicles.id','vehicles.contact','vehicles.photo','vehicles.plate','vehicles.seats','vehicles.bus_id','vehicles.car_model_id')
//            ->get()->first();
            $data = Vehicle::all();
            $data->load('bus');
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


}
