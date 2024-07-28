<?php

use App\Models\Note;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public string $title;
    public string $body;
    public string $recipient;
    public string $sendDate;
    public bool $isPublished;

    public function mount(Note $note) {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->title = $note->title;
        $this->body = $note->body;
        $this->recipient = $note->recipient;
        $this->sendDate = $note->send_date;
        $this->isPublished = $note->is_published;
    }

    public function update() {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'body' => ['required', 'string', 'min:20'],
            'recipient' => ['required', 'email'],
            'sendDate' => ['required', 'date'],
            'isPublished' => ['boolean'],
        ]);
        $this->note->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'recipient' => $validated['recipient'],
            'send_date' => $validated['sendDate'],
            'is_published' => $validated['isPublished'],
        ]);

        $this->dispatch('note-saved');
        $this->redirect(route('notes.index'), navigate: true);
    }
}; ?>

<x-slot name="header">
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		Edit Note
	</h2>
</x-slot>
<div class="py-12">
	<div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
		<x-button icon="arrow-left" class="mb-8" href="{{ route('notes.index') }}" wire:navigate>
			All Notes
		</x-button>
		<form wire:submit="update" class="space-y-4">
			<x-input wire:model="title" label="Title" placeholder="Title"/>
			<x-textarea wire:model="body" label="Body" placeholder="Body"/>
			<x-input type="email" icon="user" wire:model="recipient" label="Recipient" placeholder="user@mail.com"/>
			<x-input type="date" icon="calendar" wire:model="sendDate" label="Send Date"/>
			<x-checkbox label="Note Published" wire:model="isPublished"/>
			<div class="pt-4 flex justify-between">
				<x-button type="submit" secondary label="Save Note" spinner/>
				<x-button href="{{ route('notes.index') }}" flat negative wire:navigate>
                    Back to Notes
                </x-button>
            </div>
        </form>
        <x-action-message on="note-saved"/>
        <x-errors/>
    </div>
</div>
