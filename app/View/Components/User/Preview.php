<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Preview extends Component
{
    public $user;
    public $details;
    public $posts;

    public function __construct($user, $details, $posts)
    {
        $this->user = $user;
        $this->details = $details;
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.preview');
    }
}
