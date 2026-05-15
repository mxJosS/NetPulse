<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkOrderRequest extends FormRequest
{
    public function authorize(): bool { return true; } // Autorización en el controlador
    
    public function rules(): array {
        if (auth()->check() && auth()->user()->isEngineer()) {
            return ['status' => 'required|in:pending,on_site,completed']; // Ingenieros solo cambian estado
        }
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'service_address' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:pending,on_site,completed',
            'user_id' => 'sometimes|exists:users,id',
        ];
    }
}
