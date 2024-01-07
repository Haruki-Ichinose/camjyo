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
        $HScode_id = $request->query('HScode');
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($HScode_id);

        $tmp = $HScode_data->HScode_4;

        $category = HScode_4digits::get4digit_TableContents($tmp);

        $Country = $request->query('Country');
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
        // ⑴国名の配列入力を受け取って、データベースからidを取得。そのidを配列として確保
        $countries = $request->input('countries');
        $country_ids = [];
        
        foreach ($countries as $countryName) {
            $country_tmp = Country::where('name', $countryName)->first();
            if ($country_tmp) {
                $country_ids[] = $country_tmp->id;
            }
        }
        // ここまでで国名id配列の作成完了


        //　⑵number(HScodeの上四桁)からHScodeの内容を取得。
        $num = $request->input('number');
        $Table_of_4digit_Contents = HScode_4digits::get4digit_TableContents($num);
        $Table_of_9digit_Contents = HScode_9digits::get9digit_TableContents($num);
        $HScode_ids = [];

        foreach($Table_of_9digit_Contents as $HScode_data){
            $HScode_ids[] = $HScode_data->id;
        }

        return view('9digit.show', [ 'HScode_ids' => $HScode_ids, 'country_ids' => $country_ids,'four_digit_ctt' => $Table_of_4digit_Contents,'nine_digit_ctt' => $Table_of_9digit_Contents, 'input_countries'=> $countries]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
