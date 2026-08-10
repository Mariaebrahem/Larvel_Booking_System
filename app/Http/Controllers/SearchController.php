<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Room;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $query = Room::with(['hotel.city'])
            ->where('is_available', true);

        // Filter by city
        if ($request->filled('city')) {
            $query->whereHas('hotel.city', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->city . '%');
            });
        }

        // Filter by price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by hotel rating
        if ($request->filled('rating')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('rating', '>=', $request->rating);
            });
        }

        // Search by hotel name
        if ($request->filled('keyword')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        // Check room availability for selected dates
        if ($request->filled('check_in_date') && $request->filled('check_out_date')) {

            $checkIn = $request->check_in_date;
            $checkOut = $request->check_out_date;

            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->whereIn('status', [
                    'pending',
                    'approved',
                    'checked_in'
                ])
                ->where('check_in_date', '<', $checkOut)
                ->where('check_out_date', '>', $checkIn);
            });
        }

        $rooms = $query->paginate(10)->withQueryString();

        return view('search.results', compact('rooms'));
    }
}