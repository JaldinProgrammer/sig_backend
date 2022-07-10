<?php

namespace App\Http\Controllers;

use App\Coordinate;
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
                'outDate'=>Carbon::today()->format('Y-m-d'),
                'taken' =>1,
                'status' =>1,
                'user_id'=>$user,
                'vehicle_id' =>$vehicle
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

    public function setPosition(Request $request,$user,$vehicle){
        $driver = Driver::where('user_id', $user)->where('vehicle_id', $vehicle)->first();
        if ($driver){
            $credentials =   Request()->validate([
                'currentLat' => ['required'],
                'currentLong' => ['required'],
            ]);
            $driver->currentLat = $request->get('currentLat');
            $driver->currentLong = $request->get('currentLong');
            $driver->update();
            return response()->json($driver, Response::HTTP_OK);
        }else{
            return response()->json(['error' => "no se pudo settear la posicion"], Response::HTTP_BAD_REQUEST);
        }
    }
//http://127.0.0.1:8000/api/drivers/nearbuses/1/-17.787336129275822/-63.17928281632804
//http://127.0.0.1:8000/api/drivers/nearbuses/1/-17.77987129557522/-63.17502205921347
//-17.779748691777, -63.17403819578528
//-17.780732791589383, -63.18183382714323
    public function getBussesAround($bus,$lat,$long){
    //notice that when we parse String to float it loses decimals $string = "-63.173716753776105"; will be -63.173716753776
        $vehiclesOfBus = Driver::whereIn('vehicle_id', Vehicle::select('id')->where('bus_id',$bus)->get())->get();
        $nearBusses=array();
        foreach ($vehiclesOfBus as $vehicleOfBus) {
            if ($this->isInsideRadius($long,$lat,$vehicleOfBus->currentLong,$vehicleOfBus->currentLat)){
                $vehicleOfBus->load('vehicle');
                $vehicleOfBus->load('user');
                $nearBusses[] = $vehicleOfBus;
            }
        }
        return response()->json($nearBusses, Response::HTTP_OK);
    }

    public function isInsideRadius(float $currentX,float $currentY,float $lineX,float $lineY){
        $radius = 0.00785750092012667; //radio de 800 m  a 10 min en micro
        $d = sqrt(pow((abs($lineX) - abs($currentX)), 2) + pow((abs($lineY) - abs($currentY)), 2));
        return ($d <= $radius);
    }
//    bool isInsideRadius2(
//    double currentX, double currentY, double lineX, double lineY) {
//        const double radius = 0.002355222456223941;
//    double d = sqrt(pow((lineX.abs() - currentX.abs()), 2) +
//    pow((lineY.abs() - currentY.abs()), 2));
//    return (d <= radius);
//    }
}
