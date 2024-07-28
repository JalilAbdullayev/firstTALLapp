<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Volt\Component;

new class extends Component {
    public function with(): array {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date')->get()
        ];
    }
};
?>

<div class="space-y-2">
    @if($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">
                No notes yet
            </p>
            <p class="text-sm">
                Let's create your first note to send.
            </p>
            <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>
                Create Note
            </x-button>
        </div>
    @else
        <x-button primary icon-right="plus" class="mb-12" href="{{ route('notes.create') }}" wire:navigate>
            Create Note
        </x-button>
        <div class="grid grid-cols-3 gap-4">
            @foreach($notes as $note)
                <x-card wire:key="{{ $note->id }}">
                    <div class="flex justify-between">
                        <div>
                            <a href="" class="text-xl font-bold hover:underline hover:text-blue-500">
                                {{ $note->title }}
                            </a>
                            <p class="text-xs mt-2">
                                {{ Str::limit($note->body, 50) }}
                            </p>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ Carbon::parse($note->send_date)->format('d-M-Y') }}
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4 space-x-1">
                        <p class="text-xs">
                            Recipient: <span class="font-semibold">
                            {{ $note->recipient }}
                        </span>
                        </p>
                        <div>
                            <x-mini-button outline secondary rounded icon="eye"></x-mini-button>
                            <x-mini-button outline secondary rounded icon="trash"></x-mini-button>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
</div>
