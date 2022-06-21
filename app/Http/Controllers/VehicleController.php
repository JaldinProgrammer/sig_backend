<?php

namespace App\Http\Controllers;

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
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function vehiculosuser($id){
        try {
          //  $data = Vehicle::find($id);
            $data=DB::table('vehicles')
            ->join('buses','buses.id', '=', 'vehicles.bus_id')
            ->join('drivers','drivers.vehicle_id', '=', 'vehicles.id')
            ->where('drivers.taken','=',0)
            ->where('drivers.status','=',1)
            ->where('drivers.user_id','=',$id)
            ->get();
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
