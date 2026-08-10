<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\City;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('city')->latest()->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $cities = City::all();
        return view('admin.hotels.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_id'     => 'required|exists:cities,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'rating'      => 'nullable|numeric|min:0|max:5',
        ]);

        Hotel::create($request->only('city_id', 'name', 'description', 'address', 'rating'));

        return redirect()->route('hotels.index')->with('success', 'تم إضافة الفندق بنجاح');
    }

    public function edit(Hotel $hotel)
    {
        $cities = City::all();
        return view('admin.hotels.edit', compact('hotel', 'cities'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'city_id'     => 'required|exists:cities,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'nullable|string|max:255',
            'rating'      => 'nullable|numeric|min:0|max:5',
        ]);

        $hotel->update($request->only('city_id', 'name', 'description', 'address', 'rating'));

        return redirect()->route('hotels.index')->with('success', 'تم تعديل الفندق بنجاح');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'تم حذف الفندق بنجاح');
    }
}