<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->subject = $request->subject;
        $ticket->body = $request->body;
        $ticket->owner_id = $request->owner_id;
        $ticket->category_id = $request->category_id;
        $ticket->save();

        return redirect('/tickets')->with('success', 'The ticket has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket, $id)
    {
        $ticket = Ticket::firstWhere(['id' => $id, 'owner_id' => Auth::id()]);
        $replies = Reply::where('ticket_id', $ticket->id)->get();
        return view('tickets.show', ['ticket' => $ticket, 'replies' => $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
