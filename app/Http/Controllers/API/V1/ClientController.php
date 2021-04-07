<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new ClientService;
    }

    /**
     * @param Request $request
     * Store new client
     * @return [type]
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:pc_clients,email',
        ]);

        return $this->service->create($validated);
    }
}
