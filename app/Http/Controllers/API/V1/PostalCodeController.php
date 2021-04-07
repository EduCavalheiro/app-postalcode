<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\PostalCodeService;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new PostalCodeService;
    }

    /**
     * @param Request $request
     * Perfome search of postalcode
     * @return [type]
     */
    public function index(Request $request)
    {
        if (($r = $this->service->getPostalCode($request))) {
            if (count($r) == 0) {
                return response()->json([
                    'error' => 'Código postal não encontrado.',
                ], 404, [], JSON_UNESCAPED_UNICODE);
            }
            return response()->json([
                'data' => $r,
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'error' => 'Código Postal não encontrado.',
        ], 404, [], JSON_UNESCAPED_UNICODE);
    }
}
