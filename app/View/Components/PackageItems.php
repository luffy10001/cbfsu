<?php

namespace App\View\Components;

use App\Models\ContractPackageItems;
use App\Models\PackageItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PackageItems extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public function __construct($id)
    {
        $this->package_id =$id;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->package_id) {
            $items = PackageItem::where('package_id', $this->package_id)->get();
        } else {
            $items = [];
        }
        return view('components.package-items',compact('items'));
    }
}
