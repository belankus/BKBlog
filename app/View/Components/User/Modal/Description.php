<?php

namespace App\View\Components\User\Modal;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Description extends Component
{
    public $isDescriptionActive;
    /**
     * Create a new component instance.
     */
    public function __construct($isDescriptionActive)
    {
        $this->isDescriptionActive = $isDescriptionActive;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.modal.description');
    }
}
