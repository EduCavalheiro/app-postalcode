<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\PostalCode\Entities\PcCounty;
use Modules\PostalCode\Entities\PcDistrict;
use Modules\PostalCode\Entities\PcPostalCode;

class PostalCodeRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new PcPostalCode();
        $this->perPage = 10;
        $this->districtModel = new PcDistrict;
        $this->countyModel = new PcCounty;
    }

    /**
     * @param mixed $request
     * Import postal code
     * @return [type]
     */
    public function import($request)
    {
        if (Storage::disk('postalcode')->exists($request['importFile'])) {
            $file = Storage::disk('postalcode')->get($request['importFile']);
        } else {
            return false;
        }

        $importType = $request['importType'];

        $file = array_filter(preg_split('/\n|\r\n?/', $file), "strlen");

        $data = [];
        foreach ($file as $key => $value) {
            $info = explode(";", $value);

            switch ($importType) {
                case 'postalCode':
                    $data[$key] = $this->formatPostalCode($info);
                    break;
                case 'county':
                    $data[$key] = $this->formatCounty($info);
                    break;
                case 'district':
                    $data[$key] = $this->formatDistrict($info);
                    break;
            }
        }

        $collect = collect($data)->chunk(500);

        DB::beginTransaction();
        try {

            switch ($importType) {
                case 'postalCode':
                    $this->model->truncate();
                    break;
                case 'county':
                    $this->countyModel->truncate();
                    break;
                case 'district':
                    $this->districtModel->truncate();
                    break;
            }

            foreach ($collect as $key => $chunk) {
                switch ($importType) {
                    case 'postalCode':
                        $data[$key] = $this->model->insert($chunk->toArray());
                        break;
                    case 'county':
                        $data[$key] = $this->countyModel->insert($chunk->toArray());
                        break;
                    case 'district':
                        $data[$key] = $this->districtModel->insert($chunk->toArray());
                        break;
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return false;
        }

        return true;
    }

    /**
     * @param mixed $data
     * Format postal code to insert
     * @return [type]
     */
    private function formatPostalCode($data)
    {
        return [
            "cod_district" => $this->cleanString($data[0]),
            "cod_county" => $this->cleanString($data[1]),
            "cod_local" => $this->cleanString($data[2]),
            "local" => $this->cleanString($data[3]),
            "cod_art" => $this->cleanString($data[4]),
            "type_art" => $this->cleanString($data[5]),
            "first_prep" => $this->cleanString($data[6]),
            "title_art" => $this->cleanString($data[7]),
            "second_prep" => $this->cleanString($data[8]),
            "desig_art" => $this->cleanString($data[9]),
            "local_art" => $this->cleanString($data[10]),
            "troco" => $this->cleanString($data[11]),
            "door" => $this->cleanString($data[12]),
            "client" => $this->cleanString($data[13]),
            "cp4" => $this->cleanString($data[14]),
            "cp3" => $this->cleanString($data[15]),
            "cpalf" => $this->cleanString($data[16]),
        ];
    }

    /**
     * @param mixed $data
     * Format county to insert
     * @return [type]
     */
    private function formatCounty($data)
    {
        return [
            "cod_district" => $this->cleanString($data[0]),
            "cod_county" => $this->cleanString($data[1]),
            "desig_county" => $this->cleanString($data[2]),
        ];
    }

    /**
     * @param mixed $data
     * Format district to insert
     * @return [type]
     */
    private function formatDistrict($data)
    {
        return [
            "cod_district" => $this->cleanString($data[0]),
            "desig_district" => $this->cleanString($data[1]),
        ];
    }

    /**
     * @param mixed $request
     * Search for postal code
     * @return [type]
     */
    public function getPostalCode($postalCode)
    {
        $search = $this->model;

        $cp = str_split($postalCode, 4);
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

    /**
     * @param mixed $request
     * Search for postal code by id
     * @return [type]
     */
    public function getPostalCodeById($id)
    {
        $search = $this->model;

        $search = $search->where('id', $id);

        $search = $search->with('district')->get();

        if ($search) {
            return $this->formatResponse($search);
        }

        return false;
    }

    /**
     * @param mixed $id
     * Get district by id
     * @return [collection]
     */
    public function getDistrict($cod)
    {
        return $this->districtModel->where('cod_district', $cod)->firstOrFail();
    }

    /**
     * @param mixed $id
     * Get county by id
     * @return [collection]
     */
    public function getCounty($cod, $district)
    {
        return $this->countyModel->where('cod_county', $cod)->where('cod_district', $district)->firstOrFail();
    }

    /**
     * @param mixed $data
     * Format response
     * @return [array]
     */
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

    /**
     * @param mixed $string
     * Clean string
     * @return [type]
     */
    private function cleanString($string)
    {
        return preg_replace('~[\r\n]+~', '', mb_convert_encoding($string, "UTF-8", "auto"));
    }
}
