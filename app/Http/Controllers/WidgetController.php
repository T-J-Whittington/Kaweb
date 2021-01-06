<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class WidgetController extends Controller
{

    /**
     * Set the order page view.
     * 
     * @return View
     */
    public function order(){
        return view('order');
    }

    /**
     * Set the shipment page view.
     * @param Request $request
     * @return View with additional view data.
     */
    public function shipment(Request $request){
        return view('shipping', ['boxes' => (new Shipping)->calculateShipping($request->all()['volume'])]);
    }
}