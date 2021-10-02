<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'todo_id', 'description', 'complete'];

    /**
     * @var string[]
     */
    protected $casts = [
        'complete' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
