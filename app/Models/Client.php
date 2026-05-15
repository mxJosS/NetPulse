<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];
    public function devices() { return $this->hasMany(Device::class); }
    public function workOrders() { return $this->hasMany(WorkOrder::class); }
}
