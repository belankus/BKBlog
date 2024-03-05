<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Todolist extends Component
{
    public $todos = [];
    public $description = '';
    public $category = 'Frontend';

    protected $rules = [
        'description' => 'required',
    ];

    public function addTodo()
    {
        $this->validate();

        $this->todos[] = ['description' => $this->description, 'category' => $this->category];

        $this->description = '';
        $this->category = 'Frontend';

        $this->storeTodosInSession();
    }

    public function removeTodo($index)
    {
        unset($this->todos[$index]);
        $this->todos = array_values($this->todos);

        $this->storeTodosInSession();
    }

    public function mount()
    {
        $this->todos = Session::get('user_todos', []);
    }

    private function storeTodosInSession()
    {
        Session::put('user_todos', $this->todos);
    }

    public function render()
    {
        return view('livewire.todolist');
    }
}
