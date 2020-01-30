<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserGambleController extends Controller
{
    public function store(Request $request,$id)
    {
        $choice = $request->res;
        $money = $request->money;
        \Auth::user()->partakes($id,$choice,$money);
        return redirect('/');
    }
    
    public function destroy($id)
    {
        
        return back();
    }
}
