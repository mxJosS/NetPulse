<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioWhatsAppService
{
    protected ?string $sid;
    protected ?string $token;
    protected ?string $from;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->from = config('services.twilio.whatsapp_from');
    }

    /**
     * Envía un mensaje de WhatsApp a través de la API de Twilio.
     *
     * @param string $to Número de teléfono del destinatario
     * @param string $message Mensaje de texto a enviar
     * @return bool Retorna verdadero si se envió con éxito, o falso en caso de error o falta de credenciales
     */
    public function sendWhatsApp(string $to, string $message): bool
    {
        $toClean = $this->formatPhoneNumber($to);

        // Si faltan credenciales, simulamos en log local de desarrollo
        if (empty($this->sid) || empty($this->token) || empty($this->from)) {
            Log::warning("[Twilio] Credenciales no configuradas. Simulación de WhatsApp a {$toClean}: {$message}");
            return false;
        }

        try {
            $client = new Client($this->sid, $this->token);
            
            // Twilio requiere que el formato empiece con "whatsapp:"
            $recipient = "whatsapp:{$toClean}";
            $sender = str_starts_with($this->from, 'whatsapp:') ? $this->from : "whatsapp:{$this->from}";

            $client->messages->create($recipient, [
                'from' => $sender,
                'body' => $message,
            ]);

            Log::info("[Twilio] WhatsApp enviado con éxito a {$toClean}");
            return true;
        } catch (Exception $e) {
            Log::error("[Twilio Error] Falló el envío de WhatsApp a {$toClean}. Detalle: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Formatea el número de teléfono para asegurar el formato internacional con '+'
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Limpiar espacios, guiones y caracteres no numéricos (excepto el '+' inicial si existe)
        $phone = preg_replace('/[^\d+]/', '', $phone);

        if (!str_starts_with($phone, '+')) {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
