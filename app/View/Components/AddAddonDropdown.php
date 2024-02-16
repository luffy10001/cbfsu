<?php

namespace App\View\Components;

use App\Models\PackageAddon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddAddonDropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public function __construct($id)
    {
        $this->agency_id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $items = PackageAddon::where(['is_addone'=> 'true'])->get()->toArray();
        $agency_id = $this->agency_id;
        return view('components.add-addon-dropdown',compact('items','agency_id'));
    }
}
