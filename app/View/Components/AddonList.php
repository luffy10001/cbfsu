<?php

namespace App\View\Components;

use App\Models\Agency;
use App\Models\Area;
use App\Models\ContractPackageItems;
use App\Models\ContractsQuota;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddonList extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $agency;
    public function __construct($id,$agency)
    {
        $this->contract_id = $id;
        $this->agency_id = $agency;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->contract_id) {
            $items = ContractPackageItems::where(['contract_id'=> $this->contract_id,'is_addone'=>true])
                ->get();
        } else {
            $items = [];
        }
        // agency Areas
        $agency = Agency::with('agency_areas')->findOrFail($this->agency_id);
        $selected_areas_by_city_key = array();
        if (count($agency->agency_areas)) {
            foreach ($agency->agency_areas as $key => $value) {
                $selected_areas_by_city_key[$value['city_id']][] = $value['area_id'];
            }
        }
        // $all_areas_by_city
        $agency_areas = Area::select('id', 'cityId', 'name')
            ->whereIn('cityId', array_keys($selected_areas_by_city_key))
            ->get();
        $used_areas = ContractsQuota::select('area_id')
            ->where(['is_strip'=>true,'is_expire'=>false])
            ->whereNotIn('contract_id', [$this->contract_id])
            ->whereNotIn('contract_id', [$this->contract_id])
            ->distinct()
            ->get();
        $area_ids= [];
        if($used_areas){
            foreach($used_areas as $area){
                array_push($area_ids,$area->area_id);
            }
        }
        $areas = []; // excluded taken areas
        if ($agency_areas) {
            foreach ($agency_areas as $area) {
                if(!in_array($area->id,$area_ids)){
                    array_push($areas,$area);
                }
            }
        }
        return view('components.addon-list',compact('items','areas'));
    }
}
