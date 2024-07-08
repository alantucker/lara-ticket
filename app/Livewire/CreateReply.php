<?php

namespace App\Livewire;

use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\ReplyAdded;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class CreateReply extends Component
{
    public $ticketId = '';
    public $body = '';


    /**
     * Retrieve the custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'body.required' => 'A reply is required',
        ];
    }


    /**
     * Save the reply to the database and redirect to the ticket view page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->validate([
            'body' => 'required',
        ]);

        $reply = new Reply([
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        $ticket = Ticket::find($this->ticketId);

        $ticket->replies()->save($reply);

        $data = [
            'ticket_id' => $ticket->id,
            'ticket_subject' => $ticket->subject,
            'first_name' => $ticket->user->first_name,
            'reply_body' => $this->body,
        ];

        Notification::sendNow(User::find($ticket->owner_id), new ReplyAdded($data));

        session()->flash('status', 'Reply successfully added and email sent to the user.');

        return redirect()->to('/tickets/' . $this->ticketId);
    }


    /**
     * Render the view for the create-reply component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.create-reply');
    }
}
