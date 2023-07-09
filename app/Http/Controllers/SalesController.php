<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\User;
use App\Models\Customer;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use Session;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class SalesController extends Controller
{
    //
    public function index()
    {
        // return view('sales.index');
    }

    public function customer()
    {
        return view('sales.ListCustomer');
    }

    public function updatePassword()
    {
        $id = Session::get('id');
        return view('sales.FormUpdatePassword',compact('id'));
    }

    public function savePassword(Request $request)
    {
        // dd($request->ID);
        $sales = User::find($request->ID);
        $sales->password = bcrypt($request->password);
        $sales->save();
        return $this->sendResponse($sales, 'Berhasil');
    }

    public function formCustomer(Request $request)
    {
        $a = explode('/',\Request::getRequestUri());
        // $b = end($a);
        // dd($b);die;
        $ID = end($a)??0;
        $data = array();
        $penjualan = [];
        // var_dump($ID);die;
        if ($ID != 0 && $ID != null && $ID != 'addcustomer') {
            $customer = Customer::find($ID);
            array_push($data, $customer);
            $penjualan = Penjualan::whereRaw("customer_id = ".$ID)->get();
        }
        $paket = Paket::whereRaw("status = 1")->get();
        // dd($penjualan);
        return view('sales.FormCustomer',compact('data','paket','penjualan'));
    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::find($request->ID);
        $penjualan = Penjualan::where('customer_id', $request->ID)->delete();
        $customer->delete();
        return redirect()->route('customer');
        // dd($request->ID);
    }

    public function saveCustomer(Request $request)
    {
        // dd($request->foto == 'undefined');
        $ID = $request->ID??0;
        // var_dump($ID);
        if ($ID != 0) {
            $customer = Customer::find($ID);
        }else{
            $customer = Customer::create();
        }
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->nik = $request->nik;
        $customer->no_hp = $request->no_hp;
        
        if ($request->foto == 'undefined') {
            $image_data = $customer->foto_ktp;
        } else {
            $image = $request->foto;
            $fileName = 'foto_ktp_' . $request->nik . '_' . $request->foto->getClientOriginalName();
            $path = public_path('/images/');
            $image->move($path, $fileName);
            $image_data = '/images/' . $fileName;
        }
        

        $customer->foto_ktp = $image_data;
        $customer->jenis = $request->jenis;
        $customer->save();

        if ($ID != 0) {
            DB::table('penjualan')
                ->where('customer_id', $ID)
                ->update(['paket_id' => $request->paket]);
        }else{
            DB::table('penjualan')->insert([
                'paket_id' => $request->paket,
                'customer_id' => $customer->id,
                'sales_id' => (int)Session::get('id')
            ]);
        }

        return $this->sendResponse($customer, 'Berhasil');
    }

    public function getCustomer()
    {
        $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1;
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

        $sorting_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
        $sorting_type = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'desc';

        $columnSort = ["id","username","name","email"];

        $detailSales = Penjualan::with('customer')->with('paket')->with('sales');
        if($search != '') {
            $detailSales = $detailSales->orWhereRaw("lower(username) like '%".strtolower($search)."%'")
            // ->orWhereRaw("lower(deskripsi) like '%".strtolower($search)."%'")
            ->orWhereRaw("lower(name) like '%".strtolower($search)."%'")
            ->orWhereRaw("lower(email) like '%".strtolower($search)."%'");
       }
       $detailSales = $detailSales->orderBy($columnSort[$sorting_column], $sorting_type)
        ->get();
        $getdetailSales = $detailSales->skip($start)->take($length);
        $arr = array();
        $no = 1;
        foreach ($getdetailSales as $key => $value) {
            $arrTemp = array();
            $arrTemp[] = '<div><a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href ="/editcustomer/'.$value->customer->id.'">Edit</a>
            <a class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" href ="'.route('deleteCustomer').'?ID='.$value->customer->id.'">Hapus</a></div>
            <input class="valueID" type="text" value="'.$value->customer->id.'" hidden>';
            $arrTemp[] = $value->customer->nama;
            // $arrTemp[] = $value->deskripsi;
            $arrTemp[] = $value->customer->nik;
            $arrTemp[] = $value->paket->nama;
            $arrTemp[] = $value->sales->name;
            array_push($arr, $arrTemp);
        }
        $countData = $detailSales->count();
        $data = [
            'data' => $arr,
            'recordsFiltered' => $getdetailSales->count() ?? 0,
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
}
