<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tickets = Ticket::where('owner_id', Auth::id())->orderByDesc('priority')->paginate(3);

        return view('dashboard', ['tickets' => $tickets]);
    }
}
