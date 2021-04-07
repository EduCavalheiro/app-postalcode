<?php

namespace App\Repositories;

use App\Models\PcClient;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new PcClient();
    }

    /**
     * @param mixed $data
     * create new client postal code resource
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create($data)
    {
        $client = $this->model->create([
            'identify' => sha1($data['email'] . Carbon::now()),
            'email' => $data['email'],
            'name' => $data['name'],
            'created_at' => Carbon::now(),
        ]);

        return $client;
    }

    /**
     * @param mixed $data
     * Update menu
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update($id, $data)
    {
        $client = $this->model->find($id);

        $client->name = $data['name'];
        $client->email = $data['email'];
        $client->updated_at = Carbon::now();
        $client->save();

        return $client;
    }

    /**
     * @param mixed $identification
     * Check identification from request
     * @return [type]
     */
    public function checkIdentification($identification)
    {
        return $this->model->where('identify', $identification)->first();
    }

}
