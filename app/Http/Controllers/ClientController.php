<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DeliveryPerson;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function regClient(Request $request){
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->password = Hash::make($request->password);
        $client->dob = $request->dob;
        $client->gender = $request->gender;
        $client->save();
        if ($request->hasFile('dp')){
            $dp = $request->file('dp');
            $dpName = $client->id.'.'.$request->dp->getClientOriginalExtension();
            $dp->move(public_path('/uploads/client-dp/'),$dpName);
            $client->dp = $dpName;
            $client->save();
        }
        else{
            $client->dp = 'default.png';
            $client->save();
        }
        return view('client.login')->with('success_message','Registration Done Successfully!! Login Now..');
    }
    public function updateClient(Request $request){
        $client = Client::where('id',$request->client_id)->first();
        $client->name = $request->name;
//        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->password = Hash::make($request->password);
        $client->dob = $request->dob;
        $client->gender = $request->gender;
        if ($request->hasFile('dp')){
            if ($client->dp == 'default.png'){
                $dp = $request->file('dp');
                $dpName = $client->id.'.'.$request->dp->getClientOriginalExtension();
                $dp->move(public_path('/uploads/client-dp/'),$dpName);
                $client->dp = $dpName;
            }
            else{
                unlink(public_path('/uploads/client-dp/'.$client->dp));
                $dp = $request->file('dp');
                $dpName = $client->id.'.'.$request->dp->getClientOriginalExtension();
                $dp->move(public_path('/uploads/client-dp/'),$dpName);
                $client->dp = $dpName;
            }
        }
        $client->save();
        return redirect()->to('/settings-page')->with('profile_update', 'Your profile updated successfully!!');
    }
    public function loginClient(Request $request){
        $client = Client::where('email',$request->email)->first();
        if ($client){
            if (Hash::check($request->password, $client->password)){
                if ($client->status == 'active'){
                    session([
                        'client_id' => $client->id,
                        'client_name'=> $client->name,
                        'client_dp'=> $client->dp,
                    ]);
                    return view('client.index',compact('client'));
                }
                else{
                    return redirect()->back()->with('error_message','This Client\'s profile is deactivated by administrator');
                }
            }
            else{
                return redirect()->back()->with('error_message','Wrong Password');
            }
        }
        else{
            return redirect()->back()->with('error_message','Invalid Email Address');
        }
    }
    public function joinAsDeliveryMan(Request $request){
        DeliveryPerson::create($request->all());
        Toastr::success('You have joined as a delivery persion', 'Joined', ["positionClass" => "toast-top-right"]);
        return redirect('/profile');
    }
    public function grabOrder(Request $request){
        $deliver = DeliveryPerson::find($request->deliver_id);
        Order::where('id', $request->order_id)->update([
            'status'=> 'delivering by '.$deliver->name,
            'delivery_person_id'=> $request->deliver_id
        ]);
        Toastr::success('Order grabbed successfully', 'Grabbed', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
