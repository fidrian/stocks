<?php
namespace App\Services;

use App\Models\StockLog;
use App\Models\Stocks;
use App\Models\OrderProductDetail;
use App\Models\Alamat;
use Auth;
use DB;

class StockLogs
{
    public static function stockLogs($id, $action, $data_before=null, $data_after=null)  {
        $user       = Auth::user();
        $user_id    = $user->username;

         StockLog::insert([
            'user_id' => $user_id,
            'stock_id' => $id,
            'action' => $action,
            'data_before'=> ($data_before  != null) ? json_encode($data_before) : '[]',
            'data_after'=> ($data_after != null) ? json_encode($data_after) : '[]',
        ]);
    }
}
