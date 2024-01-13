<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\HScode_9digits;
use App\Models\HScode_4digits;
use App\Models\exportability;
use App\Models\Parents;
use App\Models\Child;
use App\Http\Controllers\Hscode_6digitController;

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

        $HScode_4 = $HScode_data -> HScode_4; 
        $category = HScode_4digits::where('HScode_4',$HScode_4)->first();
        $category = $category -> description;

        $Country = $request->input('Country');
        $Country_id = Country::getCountry_id($Country);

        $page_info = $request->input('page_info');
     
        return view('exportability.create', compact('page_info','HScode_id','HScode_data','category','Country_id','Country') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // バリデーション

      $result = exportability::create($request->except('page_info'));
      $page_info = $request -> input('page_info');
      $number = $page_info[0];
      $countries = array_slice($page_info, 1);

      return redirect()->route('6digit.access' ,['number'=>$number,'countries'=>$countries]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) //国とHScodeを確保しそのidからexportabilityを取得する。
    {
        
        $Country = $request->input('Country');
        $Country_id = Country::getCountry_id($Country);
        $HScode_id = $request->input('HScode_id');

        $exportability_data = exportability::getdatafrom_Country_and_HScode($Country_id,$HScode_id);

        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($HScode_id);

        $HScode_4 = $HScode_data -> HScode_4;
        $category = HScode_4digits::where('HScode_4',$HScode_4)->first();
        $category = $category -> description;

        $parents = Parents::orderBy('id','asc')->get();
        $children = Child::orderBy('id','asc')->get();
     
        return view('exportability.detail', compact(
            'parents',
            'children',
            'exportability_data',
            'HScode_id',
            'HScode_data',
            'category',
            'Country_id',
            'Country'
            ) );        
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

        $page_info = $request->input('page_info');
        // createと同じ処理ここまで
     
        return view('exportability.edit', compact('page_info','exportability_data','HScode_id','HScode_data','category','Country_id','Country') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
        $result = exportability::find($id)->update($request->except('page_info'));
        $page_info = $request -> input('page_info');
        $number = $page_info[0];
        $countries = array_slice($page_info, 1);
  
        return redirect()->route('6digit.access' ,['number'=>$number,'countries'=>$countries]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {

        $result = exportability::find($id)->delete();
        $page_info = $request -> input('page_info');
        $number = $page_info[0];
        $countries = array_slice($page_info, 1);
  
        return redirect()->route('6digit.access' ,['number'=>$number,'countries'=>$countries]);
    }
}