<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        $categories = Category::all();

        return view('tickets.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->subject = $request->subject;
        $ticket->body = $request->body;
        $ticket->category_id = $request->category;
        $ticket->priority = $request->priority;
        $ticket->owner_id = auth()->id();
        $ticket->save();

        return redirect('/dashboard')->with('status', 'The ticket has been successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ticket $ticket, $id)
    {
        $ticket = Ticket::firstWhere(['id' => $id, 'owner_id' => Auth::id()]);
        return view('tickets.show', ['ticket' => $ticket]);
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


    /**
     * Close a ticket.
     */
    public function close(Ticket $ticket, $id)
    {
        $ticket = Ticket::firstWhere(['id' => $id]);
        $ticket->status = 'closed';
        $ticket->save();

        return redirect('/tickets/' . $id)->with('closed', 'Ticket has been successfully closed.');
    }
}
