<?php

namespace App\View\Components\User\Modal;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Header extends Component
{
    public $name;
    public $user;
    public $details;
    public $tagline;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $user, $details, $tagline)
    {
        $this->name = $name;
        $this->user = $user;
        $this->details = $details;
        $this->tagline = $tagline;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.modal.header');
    }
}
