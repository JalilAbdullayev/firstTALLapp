<?php

use App\Models\Note;
use Livewire\Volt\Component;

new class extends Component {
    public Note $note;
    public int $heartCount;

    public function mount(Note $note) {
        $this->note = $note;
        $this->heartCount = $note->heart_count;
    }

    public function increase() {
        $this->note->heart_count++;
        $this->note->save();
        /*$this->note->update([
            'heart_count' => $this->note->heart_count + 1
        ]);*/

        $this->heartCount = $this->note->heart_count;
    }
}; ?>

<div>
	<x-button xs wire:click="increase" rose icon="heart" spinner>
		{{ $heartCount }}
    </x-button>
</div>
