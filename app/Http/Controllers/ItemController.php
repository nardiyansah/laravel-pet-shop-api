<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\File; 

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = Item::where('stok', '>', 0)->get();
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
        // cek apakah ada file nya
        if ($request->hasFile('image')) {
            // apakah upload berhasil
            if ($request->file('image')->isValid()) {
                $imageName = $request->file('image')->getClientOriginalName();
                $data = $request->all();
                $data['image'] = url('/items') . '/' . $imageName;

                // move image to public
                $request->file('image')->move(public_path('/items/'), $imageName);
                // store in database
                $result = Item::create($data);

                return $result;
            }else{
                $err['errMessage'] = 'error when uploading file';
                return $err;
            }
        }else{
            $err['errMessage'] = 'there is no file';
            return $err;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Item::find($id);
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
        // cek apakah ada file
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $imageName = $request->file('image')->getClientOriginalName();
                $data = $request->all();
                $data['image'] = url('/items') . '/' . $imageName;

                $image = Item::find($id)->get()[0]->image;
                $image = str_replace(url('/items').'/', '', $data);
                // delete file
                File::delete($image);

                // move image to public
                $request->file('image')->move(public_path('/items/'), $imageName);

                $result = Item::find($id)->update($data);
                $result = Item::find($id);
                return $result;
            }else{
                $err['errMessage'] = 'error when uploading file';
                return $err;
            }
        }else{
            $result = Item::find($id)->update($request->all());
            $result = Item::find($id);
            return $result;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Item::destroy($id);
        return $result;
    }

    public function soldout()
    {
        //
        $result = Item::where('stok', '<=', 0)->get();
        return $result;
    }
    
}
