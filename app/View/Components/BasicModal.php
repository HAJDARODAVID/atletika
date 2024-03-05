<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicModal extends Component
{
    public $modalName;
    public $showModal='none';
    /**
     * Create a new component instance.
     */
    public function __construct($modalName, $showModal)
    {
        $this->modalName = $modalName;
        $this->showModal = $showModal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.basic-modal');
    }
}
