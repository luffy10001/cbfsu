<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Subcontractor extends Component
{
    /**
     * Create a new component instance.
     */
    public $itemNo;
    public $contractor;
    public function __construct($itemNo,$contractor)
    {
        $this->itemNo = $itemNo;
        $this->contractor = $contractor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.subcontractor');
    }
}
