<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $title;
    public string $body;
    public string $recipient;
    public string $sendDate;

    public function store() {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'body' => ['required', 'string', 'min:20'],
            'recipient' => ['required', 'email'],
            'sendDate' => ['required', 'date'],
        ]);
        Auth::user()->notes()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'recipient' => $validated['recipient'],
            'send_date' => $validated['sendDate'],
            'is_published' => true
        ]);
        $this->redirect(route('notes.index'), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="store" class="space-y-4">
        <x-input wire:model="title" label="Title" placeholder="Title"/>
        <x-textarea wire:model="body" label="Body" placeholder="Body"/>
        <x-input type="email" icon="user" wire:model="recipient" label="Recipient" placeholder="user@mail.com"/>
        <x-input type="date" icon="calendar" wire:model="sendDate" label="Send Date"/>
        <div class="pt-4">
            <x-button type="submit" right-icon="calendar" label="Schedule Note" spinner/>
        </div>
    </form>
    <x-errors/>
</div>
