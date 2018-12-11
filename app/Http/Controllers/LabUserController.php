<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Lab;
use App\User;
use Illuminate\Support\Facades\DB;

class LabUserController extends Controller
{
    public function allocateUser(Request $request ,$id)
    {
        $lab = Lab::findOrFail($id);
        $technician = User::findOrFail($request->technician_id);
        $lab->users()->attach($technician);
        return redirect()->back();
    }

    public function removeUser(Request $request, $id)
    {
        $lab = Lab::findOrFail($id);
        $technician = User::findOrFail($request->technician_id);
        $lab->users()->detach($technician->id);
        // return $this->ShowAll($product->categories);
    }

    public function getUserForLab(Request $request) {
        $validator = Validator::make($request->all(), [
            'lab_id'=> 'required',
        ]);
        
        $lab = Lab::findOrFail($request->lab_id);

        $users = $lab->users;

        return response()->json(['data' => $users]);
    }
}
