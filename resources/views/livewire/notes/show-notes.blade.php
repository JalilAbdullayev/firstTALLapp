<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
    <div class="grid grid-cols-2 gap-4 mt-12">
        @foreach($notes as $note)
            <x-card wire:key="{{ $note->id }}">
                <div class="flex justify-between">
                    <a href="" class="text-xl font-bold hover:underline hover:text-blue-500">
                        {{ $note->title }}
                    </a>
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
</div>
