<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

/**
 * @group Водители (Drivers)
 */
class DriverController extends Controller
{
    /**
     * Список всех водителей
     *
     * @response 200 [
     *  {
     *    "id": 1,
     *    "name": "Али",
     *    "phone": "+992900000001",
     *    "status": "available"
     *  }
     * ]
     */
    public function index()
    {
        return Driver::all();
    }

    /**
     * Создать нового водителя
     *
     * @bodyParam name string required Имя водителя.
     * @bodyParam phone string required Телефон водителя.
     *
     * @response 201 {
     *  "id": 1,
     *  "name": "Али",
     *  "phone": "+992900000001",
     *  "status": "available"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:drivers,phone',
        ]);

        return Driver::create($data);
    }

    /**
     * Показать конкретного водителя
     */
    public function show(Driver $driver)
    {
        return $driver;
    }

    /**
     * Обновить данные водителя
     */
    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'phone' => 'sometimes|string|unique:drivers,phone,' . $driver->id,
            'status' => 'sometimes|in:available,busy',
        ]);

        $driver->update($data);
        return $driver;
    }

    /**
     * Удалить водителя
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->json(['message' => 'Удалено']);
    }
}
