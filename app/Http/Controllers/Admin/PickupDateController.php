<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupDate;
use Illuminate\Http\Request;

class PickupDateController extends Controller
{
    public function index()
    {
        $holidays = PickupDate::orderBy('pickup_date', 'asc')->get();
        return view('admin.pickup-dates.index', compact('holidays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_date' => 'required|date|unique:pickup_dates,pickup_date',
            'note' => 'nullable|string|max:255',
        ]);

        PickupDate::create($request->only(['pickup_date', 'note']));

        return redirect()->back()->with('success', 'Tanggal libur berhasil ditambahkan.');
    }

    public function destroy(PickupDate $pickupDate)
    {
        $pickupDate->delete();

        return redirect()->back()->with('success', 'Tanggal libur berhasil dihapus.');
    }
}
