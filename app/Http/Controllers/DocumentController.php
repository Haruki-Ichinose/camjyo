<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Models\HScode_9digits;
use App\Models\HScode_4digits;
use App\Models\exportability;
use App\Models\Parents;
use App\Models\Child;
use App\Models\grandchild;
use App\Models\document;
use App\Http\Controllers\Hscode_6digitController;
use App\Http\Controllers\ExportabilitydigitController;

class DocumentController extends Controller
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
        $exportability_id = $request->input('exportability_id');
        
        $parent_id = $request->input('parent_id');
        $parent = Parents::getdata_fromID($parent_id);
        
        $child_id = $request->input('child_id');
        $child = Child::getdata_fromID($child_id);

        $grandchild_id = $request->input('grandchild_id');
        $grandchild = grandchild::getdata_fromID($grandchild_id);

        $exportability_data = exportability::where('id',$exportability_id)->orderBy('updated_at','desc')->first();
        $country_name = Country::getCountry_name($exportability_data -> countries_id);
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($exportability_data -> h_scode_9digits_id);
        $category = HScode_4digits::where('HScode_4',$HScode_data->HScode_4)->first();
        $category = $category -> description;
        return view('document.create',compact(
            'parent',
            'child',
            'grandchild',
            'exportability_data',
            'country_name',
            'HScode_data',
            'category'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $exportability_id = $request->input('exportability_id');
        $validator = Validator::make($request->all(), [
            'URL' => 'nullable|url',
            'description' => 'required'
        ],[
                'URL.url' => '有効なURLを入力してください。',
                'description.required'=>'書類の情報を記入してください。'
            ]
        );
        
        // バリデーション:エラー
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);;
          }

        $result = document::create($request->except('exportability_id'));

        return redirect()->route('exportability.show',['exportability' => $exportability_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {   
        $document_id = $id;
        $document_data = document::where('id',$document_id)->orderBy('updated_at','desc')->first();

        // 以下createと同じ処理
        $exportability_id = $request->input('exportability_id');
        
        $parent_id = $request->input('parent_id');
        $parent = Parents::getdata_fromID($parent_id);
        
        $child_id = $request->input('child_id');
        $child = Child::getdata_fromID($child_id);

        $grandchild_id = $request->input('grandchild_id');
        $grandchild = grandchild::getdata_fromID($grandchild_id);

        $exportability_data = exportability::where('id',$exportability_id)->orderBy('updated_at','desc')->first();
        $country_name = Country::getCountry_name($exportability_data -> countries_id);
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($exportability_data -> h_scode_9digits_id);
        $category = HScode_4digits::where('HScode_4',$HScode_data->HScode_4)->first();
        $category = $category -> description;
        return view('document.edit',compact(
            'parent',
            'child',
            'grandchild',
            'exportability_data',
            'country_name',
            'HScode_data',
            'category',
            'document_data'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $exportability_id = $request->input('exportability_id');
        $validator = Validator::make($request->all(), [
            'URL' => 'nullable|url',
            'description' => 'required'
        ],[
                'URL.url' => '有効なURLを入力してください。',
                'description.required'=>'書類の情報を記入してください。'
            ]
        );
        
        // バリデーション:エラー
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);;
          }

        $result = document::find($id)->update($request->except('exportability_id'));

        return redirect()->route('exportability.show',['exportability' => $exportability_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $exportability_id = $request->input('exportability_id');
        $result = document::find($id)->delete();
        return redirect()->route('exportability.show',['exportability' => $exportability_id]);
    }
}
