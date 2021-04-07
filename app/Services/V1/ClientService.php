<?php
namespace App\Services\V1;

use App\Repositories\ClientRepository;

class ClientService
{
    public $repository;

    public function __construct()
    {
        $this->repository = new ClientRepository();
    }

    /**
     * @param mixed $data
     * Create new client resource
     * @return [type]
     */
    public function create($data)
    {
        return $this->repository->create($data);
    }

    /**
     * @param mixed $identify
     * Check identification of current received key
     * @return [type]
     */
    public function checkIdentification($identify)
    {
        return $this->repository->checkIdentification($identify);
    }
}
