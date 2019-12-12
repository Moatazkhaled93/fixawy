<?php

namespace App\Http\Controllers\API;
use App\Orders;
use App\ServicesLocations;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrdersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerOrder(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'locationId' => 'required',
            'serviceId' => 'required'
        ]);
        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $serviceLocation = ServicesLocations::where('location_id', $input['locationId'])
        ->where('service_id', $input['serviceId'])
        ->get();
        $data =[];
        if(!$serviceLocation) {
            return $this->sendError('services does not exist.', NULL);       
        }else{
        $data['location_service_id'] = $serviceLocation[0]->id;   
        }
        $user = auth()->user();
        $data['customer_id'] = $user->id;
        $newOrder = Orders::create($data);

        return $this->sendResponse($newOrder->toArray(), 'Order created successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListOfOrders()
    {
        $orders = Orders::where('reparirmen_id',NULL)->get();
        if (is_null($orders)) {

            return $this->sendError('Orders not found.');
        }
        $listOfOrders =[];
        $count=0;

        foreach($orders as $order){
            $listOfOrders[$count]['id'] = $order->id;
            $listOfOrders[$count]['location'] = $order->serviceLocation->location->name;
            $listOfOrders[$count]['service'] = $order->serviceLocation->service->name;
            $listOfOrders[$count]['pricePerHouer'] = $order->serviceLocation->price_per_houer;
            $count++;
        }

        return $this->sendResponse($listOfOrders, 'Orders retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reservedOfOrder(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'reparirmen_id' => 'required',
            'id' => 'required'
        ]);
        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $order = Orders::find($input['id']);
        $order->reparirmen_id = $input['reparirmen_id'];
        $order->save();

        return $this->sendResponse($order, 'Order reserved successfully.');

    }
   
}
