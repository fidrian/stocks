<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stocks;
use App\Services\StockLogs;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->search) {
            $stocks = Stocks::where('is_deleted', 0)
                    ->where('sku','like','%'.$request->search.'%')
                    ->orWhere('name','like','%'.$request->search.'%')
                    ->paginate(500)
                    ->withQueryString();

            if(!$stocks[0]) {
                return back()->with("gagal","Data Stock Tidak Ditemukan");
            }
        }else{
            $stocks = Stocks::where('is_deleted', 0)
                    ->orderBy('category_id')
                    ->orderBy('name')
                    ->orderBy('model_id')
                    ->orderBy('size_id')
                    ->paginate(10)
                    ->withQueryString();
        }

        return view('content.index', compact('stocks'));
    }

    public function updateStocks($id, Request $request)
    {
        $getStocks = Stocks::where('id', $request->id)->first();

        if($request->calstok == "Ditambah"){
            $inputstock = $getStocks->stock + $request->inputstock;
            StockLogs::stockLogs($id, 'add', ['stock' => $getStocks->stock], ['stock' => $inputstock]);
        }elseif($request->calstok == "Dikurang"){
            $inputstock = $getStocks->stock - $request->inputstock;
            if($inputstock < 0){
                return back()->with("gagal","Total stock dibawah nol, silahkan cek kembali!");
            }else{
                StockLogs::stockLogs($id, 'minus', ['stock' => $getStocks->stock], ['stock' => $inputstock]);
            }
        }else{
            $inputstock = $request->inputstock;
            StockLogs::stockLogs($id, 'adjust', ['stock' => $getStocks->stock], ['stock' => $inputstock]);
        }
        
        Stocks::where('id', $id)->update([
            'stock' => $inputstock,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        return redirect()->route('index')->with('sukses', "Jumlah Stock Berhasil Diperbarui");
    }
}
