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

        $columnSort = ["id","nama","deskripsi","masa_aktif","potongan_harga","aktif"];

        DB::table('promo')
                ->where('masa_aktif', '<', date('Y-m-d'))
                ->update(['status' => '0']);

        $promo = Promo::whereRaw("lower(nama) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(deskripsi) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(masa_aktif) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(potongan_harga) like '%".strtolower($search)."%'")
        ->orWhereRaw("lower(status) like '%".strtolower($search)."%' ")
        ->orderBy($columnSort[$sorting_column], $sorting_type)
        ->get();
        $getPromo = $promo->skip($start)->take($length);
        $arr = array();
        foreach ($getPromo as $key => $value) {
            $arrTemp = array();
            $arrTemp[] = '<div><a href ="editprogram/'.$value->id.'">Edit</a></div>';
            $arrTemp[] = $value->nama;
            $arrTemp[] = $value->deskripsi;
            $arrTemp[] = $value->masa_aktif;
            $arrTemp[] = $value->potongan_harga;
            if ($value->status == 1) {
                $arrTemp[] = 'Aktif';
            }else{
                $arrTemp[] = 'Tidak Aktif';
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
        }else{
            $promo = Promo::create();
        }
        $promo->nama = $request->nama;
        $promo->deskripsi = $request->deskripsi;
        $promo->masa_aktif = date('Y-m-d',strtotime($request->masa_aktif));
        $promo->potongan_harga = $request->potongan_harga;
        $promo->status = $request->status??1;
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
