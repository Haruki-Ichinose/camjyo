<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\HScode_4digits;
use App\Models\HScode_9digits;
use App\Models\exportability;

class Hscode_6digitController extends Controller
{   

    public function index(Request $request)
    {
        $num = $request->input('number');

        $Table_of_4digit_Contents = HScode_4digits::get4digit_TableContents($num);
        $Table_of_9digit_Contents = HScode_9digits::get9digit_TableContents($num);

        // cttはcontents(内容)の略語のつもりです。 
        return view('9digit.index', ['four_digit_ctt' => $Table_of_4digit_Contents,'nine_digit_ctt' => $Table_of_9digit_Contents]);

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

        // ⑴と⑵で作ったid配列からexportabilityを検索して、それぞれのexportabilityを獲得する機構を作る
        $exportabilities = [];
        foreach ($country_ids as $country_id) {
            foreach ($HScode_ids as $HScode_id) {
                $exportability = exportability::getdatafrom_Country_and_HScode($country_id,$HScode_id);
    
                if (!isset($exportabilities[$country_id])) {
                    $exportabilities[$country_id] = []; // 国IDごとに配列を初期化
                }
    
                // 未入力（null）の場合でもキーと値を設定
                $exportabilities[$country_id][$HScode_id] = $exportability ?? null;
            }
        }
        // ここまででexportability二次元配列の取得完了

        return view('9digit.show', [
            'HScode_ids' => $HScode_ids,
            'country_ids' => $country_ids,
            'four_digit_ctt' => $Table_of_4digit_Contents,
            'nine_digit_ctt' => $Table_of_9digit_Contents,
            'input_countries'=> $countries,
            'exportabilities' => $exportabilities
        ]);
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

    public function access(Request $request) 
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

        // ⑴と⑵で作ったid配列からexportabilityを検索して、それぞれのexportabilityを獲得する機構を作る
        $exportabilities = [];
        foreach ($country_ids as $country_id) {
            foreach ($HScode_ids as $HScode_id) {
                $exportability = exportability::getdatafrom_Country_and_HScode($country_id,$HScode_id);
    
                if (!isset($exportabilities[$country_id])) {
                    $exportabilities[$country_id] = []; // 国IDごとに配列を初期化
                }
    
                // 未入力（null）の場合でもキーと値を設定
                $exportabilities[$country_id][$HScode_id] = $exportability ?? null;
            }
        }
        // ここまででexportability二次元配列の取得完了

        return view('9digit.show', [
            'HScode_ids' => $HScode_ids,
            'country_ids' => $country_ids,
            'four_digit_ctt' => $Table_of_4digit_Contents,
            'nine_digit_ctt' => $Table_of_9digit_Contents,
            'input_countries'=> $countries,
            'exportabilities' => $exportabilities
        ]);
    }

}
