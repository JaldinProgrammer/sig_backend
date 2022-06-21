<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;

use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\User;
class DriverController extends Controller
{
    public function ocupar($user,$vehicle){
        $usuario=User::where('id',$user)->get()->first();
        $micro=Vehicle::find($vehicle);
        if ($usuario && $micro){
            $data=Driver::create([
                'inDate'=>Carbon::today()->format('Y-m-d'),
                'taken' =>1,
                'status' =>1,
                'user_id'=>$user,
                'vehicle' =>$vehicle
            ]);
            return response()->json($data, Response::HTTP_OK);
        }else{
            return response()->json(['error' => "no se encontro el usuario o vehiculo"], Response::HTTP_BAD_REQUEST);
        }
        
    }
    public function liberar($user,$vehicle){
        $usuario=User::find($user);
        $micro=Vehicle::find($vehicle);
        if ($usuario && $micro){
            $data=Driver::where('user_id',$user)->where('vehicle_id',$vehicle)->get()->first();
            $data->update([
                'outDate'=>Carbon::today()->format('Y-m-d'),
                'taken' =>0,
            ]);
            return response()->json($data, Response::HTTP_OK);
        }else{
            return response()->json(['error' => "no se encontro el usuario o vehiculo"], Response::HTTP_BAD_REQUEST);
        }
    }
}
