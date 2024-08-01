<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {

    public function with(): array {
        return [
            'sentCount' => Auth::user()->notes()->where('send_date', '<', now())->whereIsPublished(true)->count(),
            'lovedCount' => Auth::user()->notes->sum('heart_count'),
        ];
    }
}; ?>

<div class="grid md:grid-cols-2 gap-4">
	<div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
		<div class="flex items-center">
			<div>
				<p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
					Notes Sent
				</p>
			</div>
		</div>
		<div class="mt-6">
			<p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">
				{{ $sentCount }}
			</p>
		</div>
	</div>
	<div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
		<div class="flex items-center">
			<div>
				<p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
					Notes Loved
				</p>
			</div>
		</div>
		<div class="mt-6">
			<p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">
				{{ $lovedCount }}
            </p>
        </div>
    </div>
</div>
