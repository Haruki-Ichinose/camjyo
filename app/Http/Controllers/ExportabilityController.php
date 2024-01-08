<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\HScode_9digits;
use App\Models\HScode_4digits;
use App\Models\exportability;

class ExportabilityController extends Controller
{
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
    public function create(Request $request)
    {
    
        $HScode_id = $request->input('HScode_id');
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($HScode_id);

        $category = $request->input('category');

        $Country = $request->input('Country');
        $Country_id = Country::getCountry_id($Country);
     
        return view('exportability.create', compact('HScode_id','HScode_data','category','Country_id','Country') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // バリデーション

      $result = exportability::create($request->all());
      
      return redirect() -> route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) //国とHScodeを確保しそのidからexportabilityを取得する。
    {
        $exportability_id = $request->input('exportability_id'); 
        $exportability_data = exportability::where('id',$exportability_id)->orderby('updated_at','desc')->first();

        // ここからcreateと同じ処理
        $HScode_id = $request->input('HScode_id');
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($HScode_id);

        $category = $request->input('category');

        $Country = $request->input('Country');
        $Country_id = Country::getCountry_id($Country);
        // createと同じ処理ここまで
     
        return view('exportability.detail', compact('exportability_data','HScode_id','HScode_data','category','Country_id','Country') );        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $exportability_id = $request->input('exportability_id'); 
        $exportability_data = exportability::where('id',$exportability_id)->orderby('updated_at','desc')->first();

        // ここからcreateと同じ処理
        $HScode_id = $request->input('HScode_id');
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($HScode_id);

        $category = $request->input('category');

        $Country = $request->input('Country');
        $Country_id = Country::getCountry_id($Country);
        // createと同じ処理ここまで
     
        return view('exportability.edit', compact('exportability_data','HScode_id','HScode_data','category','Country_id','Country') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
        $result = exportability::find($id)->update($request->all());
        return redirect() -> route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = exportability::find($id)->delete();
        return redirect() -> route('dashboard');
    }
}
