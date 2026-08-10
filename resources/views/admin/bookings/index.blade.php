@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>All Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Hotel</th>
                    <th>Room</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($bookings as $booking)

                    <tr>

                        <td>{{ $booking->id }}</td>

                        <td>
                            {{ $booking->user->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $booking->room->hotel->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $booking->room->name ?? $booking->room->id }}
                        </td>

                        <td>
                            {{ $booking->check_in_date }}
                        </td>

                        <td>
                            {{ $booking->check_out_date }}
                        </td>

                        <td>
                            {{ $booking->total_price }}
                        </td>

                        <td>
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </td>

                        <td>

                            @if($booking->status === 'pending')

                                <form action="{{ route('bookings.approve', $booking->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-success btn-sm">
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('bookings.reject', $booking->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Reject
                                    </button>
                                </form>

                            @elseif($booking->status === 'approved')

                                <form action="{{ route('bookings.checkIn', $booking->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-primary btn-sm">
                                        Check In
                                    </button>
                                </form>

                            @elseif($booking->status === 'checked_in')

                                <form action="{{ route('bookings.checkOut', $booking->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-warning btn-sm">
                                        Check Out
                                    </button>
                                </form>

                            @else

                                <span class="text-muted">
                                    No Action
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="text-center">
                            No bookings found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{ $bookings->links() }}

</div>

@endsection