<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionController extends Controller
{
    public function create(Request $request){
        try {
            $request->validate([
//                'date' => ['required'],
                'isLogin' => ['required'],
                'message' => ['required'],
                'user_id' => ['required'],
                'vehicle_id' => ['required'],
            ]);
            $driver = Driver::where('user_id',$request['user_id'])->where('vehicle_id',$request['vehicle_id'])->first();
            if ($driver){
                $session = Session::create([
                    'date' => $request['date'],
                    'isLogin'=> $request['isLogin'],
                    'message'=> $request['message'],
                    'driver_id' => $driver->id
                ]);
                return response()->json($session,Response::HTTP_OK);
            }else{
                return response()->json('no se encontro driver'. $driver->id, Response::HTTP_BAD_REQUEST);
            }

        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }

}
