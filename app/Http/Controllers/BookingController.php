<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show the current user's bookings
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('room.hotel')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    // Create a new booking
    public function store(StoreBookingRequest $request)
    {
        $room = Room::findOrFail($request->room_id);

        if (! $room->is_available) {
            return back()->with('error', 'This room is currently unavailable.');
        }

        if ($this->hasConflict($room->id, $request->check_in_date, $request->check_out_date)) {
            return back()->with('error', 'This room is not available for the selected dates.');
        }

        $nights = \Carbon\Carbon::parse($request->check_in_date)
            ->diffInDays(\Carbon\Carbon::parse($request->check_out_date));

        $totalPrice = $nights * $room->price;

        Booking::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Booking created successfully. Waiting for approval.');
    }

    // Update an existing booking's dates (only while still pending)
    public function update(StoreBookingRequest $request, $id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be modified.');
        }

        $room = Room::findOrFail($request->room_id);

        if (! $room->is_available) {
            return back()->with('error', 'This room is currently unavailable.');
        }

        if ($this->hasConflict($request->room_id, $request->check_in_date, $request->check_out_date, $booking->id)) {
            return back()->with('error', 'This room is not available for the selected dates.');
        }

        $nights = \Carbon\Carbon::parse($request->check_in_date)
            ->diffInDays(\Carbon\Carbon::parse($request->check_out_date));

        $booking->update([
            'room_id' => $room->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_price' => $nights * $room->price,
        ]);

        return back()->with('success', 'Booking updated successfully.');
    }

    // Cancel a booking (by its owner) - only allowed while pending or approved
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (! in_array($booking->status, ['pending', 'approved'])) {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    // Admin approves a booking - only while pending; re-checks room availability and conflicts
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be approved.');
        }

        $room = Room::findOrFail($booking->room_id);

        if (! $room->is_available) {
            return back()->with('error', 'Cannot approve: this room is currently unavailable.');
        }

        if ($this->hasConflict($booking->room_id, $booking->check_in_date, $booking->check_out_date, $booking->id)) {
            return back()->with('error', 'Cannot approve: this room now conflicts with another approved booking.');
        }

        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved.');
    }

    // Admin rejects a booking - only allowed while pending
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be rejected.');
        }

        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Booking rejected.');
    }

    // Guest check-in
    public function checkIn($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'approved') {
            return back()->with('error', 'Booking must be approved before check-in.');
        }

        $booking->update(['status' => 'checked_in']);

        return back()->with('success', 'Checked in successfully.');
    }

    // Guest check-out
    public function checkOut($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'checked_in') {
            return back()->with('error', 'Guest must be checked in first.');
        }

        $booking->update(['status' => 'checked_out']);

        return back()->with('success', 'Checked out successfully.');
    }

    // Private helper: checks whether a room has an overlapping booking
    // Used by store(), update(), and approve()
    private function hasConflict($roomId, $checkIn, $checkOut, $excludeBookingId = null)
    {
        $query = Booking::where('room_id', $roomId)
            ->whereIn('status', ['pending', 'approved', 'checked_in'])
            ->where('check_in_date', '<', $checkOut)
            ->where('check_out_date', '>', $checkIn);

        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return $query->exists();
    }
}