<?php

namespace App\Services\V1;

use App\Models\PcPostalCode;

class PostalCodeService
{
    public function __construct()
    {
        $this->model = new PcPostalCode();
    }

    /**
     * @param mixed $request
     * Search for postal code
     * @return [type]
     */
    public function getPostalCode($request)
    {
        $search = $this->model;

        $cp = str_split($request->postalCode, 4);
        $cp4 = $cp[0];
        $cp3 = $cp[1];

        $search = $search->where('cp4', $cp4);
        $search = $search->where('cp3', $cp3);

        $search = $search->with('district')->get();

        if ($search) {
            return $this->formatResponse($search);
        }

        return false;
    }

    private function formatResponse($data)
    {
        $response = $data->map(function ($item) {
            return [
                "id" => $item->id,
                "CodigoPostal" => $item->postal_code,
                "Morada" => $item->complete_art,
                "CodigoLocalidade" => $item->cod_local,
                "Localidade" => $item->local,
                "CodigoConcelho" => $item->county()->cod_county,
                "Concelho" => $item->county()->desig_county,
                "CodigoDistrito" => $item->district->cod_district,
                "Distrito" => $item->district->desig_district,
                "DesignacaoPostal" => $item->cpalf,
            ];
        });

        return $response;
    }
}
