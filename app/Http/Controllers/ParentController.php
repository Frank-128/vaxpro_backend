<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentsGuardians;
use Illuminate\Support\Facades\Log;

class ParentController extends Controller
{
    public function parents(Request $request){
        $nida_no = $request->nidaNo;

        if (!empty($nida_no)) {

            $parent = ParentsGuardians::where('nida_id', $nida_no)->with('user')->first();
       if($parent){
           return response()->json($parent, 200);

       }
            return response()->json(null,404);

        }
        return response()->noContent();

    }
}

