<?php

namespace App\Http\Middleware\API;

use App\Services\V1\ClientService;
use Closure;

class ClientIdentificationMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $service = new ClientService;

        if (!$request->input('identify')) {
            return response()->json([
                'error' => 'Identificação não recebida por parte do cliente.',
            ], 403, [], JSON_UNESCAPED_UNICODE);
        }

        if (!($client = $service->checkIdentification($request->input('identify')))) {
            return response()->json([
                'error' => 'Identificação inválida.',
            ], 401, [], JSON_UNESCAPED_UNICODE);
        }

        if (!($client->active)) {
            return response()->json([
                'error' => 'Cliente desativado.',
            ], 401, [], JSON_UNESCAPED_UNICODE);
        }

        if (!$request->input('postalCode')) {
            return response()->json([
                'error' => 'Código Postal não recebido por parte do cliente.',
            ], 406, [], JSON_UNESCAPED_UNICODE);
        }

        if (!is_numeric($request->input('postalCode'))) {
            return response()->json([
                'error' => 'Código Postal inválido. O código postal deve ser composto por sete (7) dígitos numéricos.',
            ], 406, [], JSON_UNESCAPED_UNICODE);
        }

        if (strlen($request->input('postalCode')) !== 7) {
            return response()->json([
                'error' => 'Código Postal inválido. O Código Postal precisa ter 7 dígitos numéricos.',
            ], 406, [], JSON_UNESCAPED_UNICODE);
        }

        $request->request->add(['client' => $client->toArray()]);

        return $next($request);
    }
}
