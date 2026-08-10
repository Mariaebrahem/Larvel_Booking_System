<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Room::with(['hotel.city'])
            ->where('is_available', true);

        // فلترة بالمدينة
        if ($request->filled('city')) {
            $query->whereHas('hotel.city', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->city . '%');
            });
        }

        // فلترة بالسعر (من - إلى)
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // فلترة بالتقييم (تقييم الفندق)
        if ($request->filled('rating')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('rating', '>=', $request->rating);
            });
        }

        // بحث بالاسم (اسم الفندق)
        if ($request->filled('keyword')) {
            $query->whereHas('hotel', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        // فلترة بالتوافر في فترة تواريخ معينة (لو المستخدم بعت check_in و check_out)
        if ($request->filled('check_in_date') && $request->filled('check_out_date')) {
            $checkIn = $request->check_in_date;
            $checkOut = $request->check_out_date;

            $query->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->whereIn('status', ['pending', 'approved', 'checked_in'])
                    ->where('check_in_date', '<', $checkOut)
                    ->where('check_out_date', '>', $checkIn);
            });
        }

        $rooms = $query->paginate(10)->withQueryString();

        return view('search.results', compact('rooms'));
    }
}