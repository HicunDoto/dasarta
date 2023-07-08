<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Promo;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class MarketingController extends Controller
{
    //
    public function index()
    {

    }

    public function program()
    {
        return view('marketing.ListPromo');
    }

    public function getProgram()
    {
        $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1;
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $sorting_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
        $sorting_type = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'desc';

        $columnSort = ["id","nama","masa_aktif","potongan_harga","aktif"];

        DB::table('promo')
                ->where('masa_aktif', '<', date('Y-m-d'))
                ->update(['status' => '0']);

        $promo = Promo::whereRaw("lower(nama) like '%".strtolower($search)."%'")
        // ->orWhereRaw("lower(deskripsi) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(masa_aktif) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(potongan_harga) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(status) like '%".strtolower($search)."%' ")
        ->orderBy($columnSort[$sorting_column], $sorting_type)
        ->get();
        $getPromo = $promo->skip($start)->take($length);
        $arr = array();
        foreach ($getPromo as $key => $value) {
            $arrTemp = array();
            $arrTemp[] = '<div><a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href ="/editprogram/'.$value->id.'">Edit</a></div><input class="valueID" type="text" value="'.$value->id.'" hidden>';
            $arrTemp[] = $value->nama;
            // $arrTemp[] = $value->deskripsi;
            $arrTemp[] = $value->masa_aktif;
            $arrTemp[] = $value->potongan_harga;
            if ($value->status == 1) {
                $arrTemp[] = '<label class="relative inline-flex items-center cursor-pointer"><input id="checked-status" type="checkbox" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div></label>';
                // $arrTemp[] = 'Aktif';
            }else{
                $arrTemp[] = '<label class="relative inline-flex items-center cursor-pointer"><input id="checked-status" type="checkbox" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div></label>';
                // $arrTemp[] = 'Tidak Aktif';
            }
            array_push($arr, $arrTemp);
        }
        $countData = $promo->count();
        $data = [
            'data' => $arr,
            'recordsFiltered' => $getPromo->count() ?? 0,
            'recordsTotal' => $countData ?? 0,
            'colomn_sort' => "",
            'params_arr' => "",
            'sql' => "",
            'arr_show' => "",
            'draw' => $draw,
            'start_from' => $start,
        ];
        return json_encode($data);
    }

    public function formProgram(Request $request)
    {
        $a = explode('/',\Request::getRequestUri());
        // $b = end($a);
        // dd($b);die;
        $ID = end($a)??0;
        $data = array();
        if ($ID != 0 && $ID != null) {
            $promo = Promo::find($ID);
            array_push($data, $promo);
        }
        return view('marketing.FormPromo',compact('data'));
    }

    public function saveProgram(Request $request)
    {
        // dd($request);
        $ID = $request->ID??0;
        if ($ID != 0) {
            $promo = Promo::find($ID);
            $promo->status = $request->status??1;
        }else{
            $promo = Promo::create();
            $promo->status = 1;
        }
        $promo->nama = $request->nama;
        $promo->deskripsi = $request->deskripsi;
        $promo->masa_aktif = date('Y-m-d',strtotime($request->masa_aktif));
        $promo->potongan_harga = $request->potongan_harga;
        $promo->save();

        return $this->sendResponse($promo, 'Berhasil');
    }

    public function saveStatus(Request $request)
    {
        // dd($request);
        $ID = $request->ID??0;
        if ($ID != 0) {
            $promo = Promo::find($ID);
        }
        $promo->status = $request->status;
        $promo->save();

        return $this->sendResponse($promo, 'Berhasil');
    }

    public function paketLayanan()
    {
        
    }

    public function customer()
    {
        
    }

    public function sales()
    {
        
    }
}
