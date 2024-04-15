<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'completed'
    ];

    public function getAllTodos()
    {
        return Todo::all();
    }

    /**
     * Find a todo by its ID
     *
     * @param int $id
     * @return \App\Models\Todo|null
     */
    public function findTodoById($id)
    {
        return Todo::find($id);
    }
}
