<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = User::all();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = User::create($request->all());
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = User::find($id)->update($request->all());
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = User::destroy($id);
        return $result;
    }

    public function about()
    {
        $about = "Kami adalah penyedia segala kebutuhan peliharaan anda";
        $address = User::find(1)->all()[0]["address"];
        
        $data["about"] = $about;
        $data["address"] = $address;

        return $data;
    }

    public function login(Request $request)
    {
        $data = $request->all();
        if(empty($data["name"])) {
            $data["name"] = '';
        }
        if(empty($data["password"])) {
            $data["password"] = '';
        }

        $result = User::where('name', $data["name"])->where('password', $data["password"])->get();

        if (empty($result[0])) {
            $response["message"] = "user does'n exist";
            $response["code"] = 404;
        } else {
            $response = $result[0];
            $response["message"] = "user exist";
            $response["code"] = 200;
        }

        return $response;
    }
}
