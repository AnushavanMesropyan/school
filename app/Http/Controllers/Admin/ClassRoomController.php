<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = ClassRoom::get();
        return view('admin.class-room.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class-room.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        ClassRoom::create($request->all());
        return redirect()->route('class-room.index')
            ->with('success', 'ClassRoom created successfully.');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $item = ClassRoom::find($id);
        return view('admin.class-room.form',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @par am  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $product = ClassRoom::find($id);

        $product->update($request->all());

        return redirect()->route('class-room.index')
            ->with('success', 'ClassRoom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ClassRoom::find($id);

        $product->delete();

        return redirect()->route('class-room.index')
            ->with('success', 'ClassRoom deleted successfully');
    }
}
