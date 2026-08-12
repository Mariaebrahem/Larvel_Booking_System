<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // عرض حجوزات المستخدم الحالي
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('room.hotel')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function store(StoreBookingRequest $request)
    {
        $room = Room::findOrFail($request->room_id);

        $conflict = Booking::where('room_id', $room->id)
            ->whereIn('status', ['pending', 'approved', 'checked_in'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('check_in_date', '<=', $request->check_in_date)
                        ->where('check_out_date', '>=', $request->check_out_date);
                    });
            })
            ->exists();

        if ($conflict) {
            return response()->json([
                'success' => false,
                'message' => 'هذه الغرفة غير متاحة في التواريخ المختارة.',
            ], 422);
        }

        $nights = \Carbon\Carbon::parse($request->check_in_date)
            ->diffInDays(\Carbon\Carbon::parse($request->check_out_date));

        $totalPrice = $nights * $room->price;

        $booking = Booking::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء الحجز بنجاح، في انتظار الموافقة.',
            'booking' => $booking,
        ]);
    }
    // إلغاء الحجز (المستخدم نفسه)
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (in_array($booking->status, ['checked_in', 'checked_out'])) {
            return back()->with('error', 'Cannot cancel this booking anymore.');
        }

        $booking->delete();

        return back()->with('success', 'تم إلغاء الحجز وحذفه بنجاح.');
    }

    // موافقة الأدمن على الحجز
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved.');
    }

    // رفض الأدمن للحجز
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Booking rejected.');
    }

    // تسجيل دخول النزيل (Check In)
    public function checkIn($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'approved') {
            return back()->with('error', 'Booking must be approved before check-in.');
        }

        $booking->update(['status' => 'checked_in']);

        return back()->with('success', 'Checked in successfully.');
    }

    // تسجيل خروج النزيل (Check Out)
    public function checkOut($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'checked_in') {
            return back()->with('error', 'Guest must be checked in first.');
        }

        $booking->update(['status' => 'checked_out']);

        return back()->with('success', 'Checked out successfully.');
    }
}
