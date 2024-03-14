<?php

namespace App\View\Components\User\Modal;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Location extends Component
{

    public $details;
    public $location;
    public $website;

    public function __construct($details, $location, $website)
    {
        $this->details = $details;
        $this->location = $location;
        $this->website = $website;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.modal.location');
    }
}
