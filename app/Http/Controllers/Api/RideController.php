<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\Driver;
use Illuminate\Http\Request;

/**
 * @group Заказы (Rides)
 */
class RideController extends Controller
{
    /**
     * Получить список всех заказов
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "customer_name": "Али",
     *     "pickup_location": "ТЦ Сиёма",
     *     "dropoff_location": "Аэропорт",
     *     "status": "pending"
     *   }
     * ]
     */
    public function index()
    {
        return Ride::all();
    }

    /**
     * Создать новый заказ
     *
     * @bodyParam customer_name string required Имя клиента.
     * @bodyParam pickup_location string required Местоположение для подъезда.
     * @bodyParam dropoff_location string required Местоположение для высадки.
     *
     * @response 201 {
     *  "id": 1,
     *  "customer_name": "Али",
     *  "pickup_location": "ТЦ Сиёма",
     *  "dropoff_location": "Аэропорт",
     *  "status": "pending"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string',
            'pickup_location' => 'required|string',
            'dropoff_location' => 'required|string',
        ]);

        return Ride::create($data);
    }

    /**
     * Назначить водителя на заказ
     *
     * @bodyParam driver_id int required ID водителя.
     * @response 200 {
     *   "id": 1,
     *   "customer_name": "Али",
     *   "pickup_location": "ТЦ Сиёма",
     *   "dropoff_location": "Аэропорт",
     *   "status": "assigned",
     *   "driver_id": 1
     * }
     */
    public function assignDriver(Ride $ride, Driver $driver)
    {
        $ride->driver_id = $driver->id;
        $ride->status = 'assigned';
        $ride->save();

        return response()->json($ride);
    }

    /**
     * Показать конкретный заказ
     */
    public function show(Ride $ride)
    {
        return $ride;
    }

    /**
     * Обновить заказ
     */
    public function update(Request $request, Ride $ride)
    {
        $data = $request->validate([
            'customer_name' => 'sometimes|string',
            'pickup_location' => 'sometimes|string',
            'dropoff_location' => 'sometimes|string',
            'status' => 'sometimes|in:pending,assigned,completed',
        ]);

        $ride->update($data);
        return $ride;
    }

    /**
     * Удалить заказ
     */
    public function destroy(Ride $ride)
    {
        $ride->delete();
        return response()->json(['message' => 'Удалено']);
    }
}
