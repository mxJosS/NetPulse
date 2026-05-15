<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
    protected $fillable = ['client_id', 'brand', 'model', 'serial_number', 'ip_address'];
    public function client() { return $this->belongsTo(Client::class); }
    public function workOrders() { return $this->hasMany(WorkOrder::class); }
}
