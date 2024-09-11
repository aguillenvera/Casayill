<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function salessummary()
    {
       
        return view('upload.salessummary')->with("upload");
    }

    public function comps()
    {
       
        return view('upload.comps')->with("upload");
    }

    public function voids()
    {
       
        return view('upload.voids')->with("upload");
    }
    public function promos()
    {
       
        return view('upload.promos')->with("upload");
    }
    public function payments()
    {
       
        return view('upload.payments')->with("upload");
    }
    public function mix()
    {
       
        return view('upload.mix')->with("upload");
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        //
    }
}
