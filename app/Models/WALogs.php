<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WALogs extends Model {
    public $timestamps = true;
    protected  $table = 'wa_logs';
    protected $fillable = ['destination','endpoint', 'request', 'response'];
}