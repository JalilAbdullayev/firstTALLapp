<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model {
    use HasUuids, HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
protected $casts = [
    'is_published' => 'boolean',
];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
