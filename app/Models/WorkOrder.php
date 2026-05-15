<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $fillable = ['client_id', 'device_id', 'user_id', 'title', 'description', 'service_address', 'status', 'cancellation_reason'];
    public function client() { return $this->belongsTo(Client::class); }
    public function device() { return $this->belongsTo(Device::class); }
    public function engineer() { return $this->belongsTo(User::class, 'user_id'); }

    public function formattedStatus()
    {
        return str_replace('_', ' ', strtoupper($this->status));
    }
}
