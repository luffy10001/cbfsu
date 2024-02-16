<?php

use App\Models\Agency;
use App\Models\AssignUserAgency;
use App\Models\ContractProperties;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use App\Models\UserArea;
use App\Models\UsersMappings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ContractsQuota;
use App\Models\Payment;
use App\Models\PropertyLogs;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\Contract;
use App\Models\GraceTime;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

if (!function_exists('TableName')) {
    function TableName($table_name)
    {
        return with(new $table_name)->getTable();
    }
}


if (!function_exists('mws_encrypt')) {
    function mws_encrypt($action, $string): string
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'classified_crm';
        $secret_iv = 'classified_crm';
        $key = hash('sha256', $secret_key);

        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'E') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'D') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
if (!function_exists('isAccessible')) {
    function isAccessible($Value): bool
    {
        return isPermission($Value);
    }
}

if (!function_exists('isPermission')) {
    function isPermission($route, $role = null): bool
    {
        if ($role) {
            $permissions = role_permissions($role);
        } else {
            $permissions = request()->get('user_permissions');
        }

        try {
            foreach ($permissions as $row) {
                if ($row['routeName'] == $route) {
                    return true;
                }
            }
        } catch (\Exception $ex) {
        }
        return false;
    }
}


if (!function_exists('role_permissions')) {
    function role_permissions($role): array
    {
        return $role->permissions()
            ->select('id as permissionId', 'route_name as routeName', 'role_id as roleId')
            ->where('is_active', true)
            ->get()
            ->toArray();
    }
}
if (!function_exists('isCurrentRoute')) {
    function isCurrentRoute($routeName): bool
    {
        return request()->routeIs($routeName);
    }
}
if (function_exists('mws_user_area')) {
    function mws_user_area($user_areas, $area_id): bool
    {
        $flag = false;
        foreach ($user_areas as $area) {
            if ($area['area_id'] === $area_id) {
                $flag = true;
            }
        }
        return $flag;
    }

}

if (function_exists('mws_user_agency')) {
    function mws_user_area($user_agencies, $agency_id): bool
    {
        $flag = false;

        foreach ($user_agencies as $agency) {
            if ($agency['id'] === $agency_id) {
                $flag = true;

            }
        }
        return $flag;
    }

}
if (!function_exists('isNotifyableUsers')) {
    function isNotifyableUsers($area_id, $role)
    {
        $data = UserArea::from(TableName(UserArea::class) . " as ua")
            ->join(TableName(User::class) . " as u", 'u.id', '=', 'ua.user_id')
            ->join(TableName(Role::class) . " as r", 'r.id', '=', 'u.role_id')
            ->where('ua.area_id', $area_id)
            ->where('r.slug', $role)
            ->select('u.id as user_id')
            ->first();
        return $data;
    }
}

if (!function_exists('contract_status')) {
    function contract_status(): array
    {
        return array(
            'draft' => 'Draft',
            'pending_approval' => 'Pending Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'active' => 'Active',
            'expired' => 'Expired',
            'blocked' => 'Blocked',
            'inactive' => 'Inactive',
        );
    }
}

if (!function_exists('contract_categories')) {
    function contract_categories(): array
    {
        return array(
            'new' => 'New',
            'renewal' => 'Renewal',
            'upsell' => 'Upsell',
            'upgrade' => 'Upgrade',
        );
    }
}
if (!function_exists('reached_types')){
    function reached_types(): array
    {
        return array(
            'online' => 'Online Request',
            'on_call' => 'On Call Request',
            'in_house' => 'In House Request',
        );
    }
}
if (!function_exists('grace_time')) {
    function grace_time(): array
    {
        $graceTime = GraceTime::find(1);
        return array(
            'payment' => $graceTime->payment??0,
            'contract' => $graceTime->contract??0,
        );
    }
}
if (!function_exists('payment_status')) {
    function payment_status(): array
    {
        return array(
            'draft' => 'Draft',
            'Pending Approval' => 'Pending Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        );
    }
}
if (!function_exists('propertyReviewStatus')) {
    function propertyReviewStatus()
    {
        return array(
            'draft' => 'Draft',
            'pending' => 'Pending',
            'rejected' => 'Rejected',
            'published' => 'Published',
        );
    }
}


if (!function_exists('active_contract_amount')) {
    function active_contract_amount($contract)
    {
        if (Payment::select('contract_id', 'amount_paid')->where(['contract_id' => $contract->id, 'parent_id' => null])->exists()) {
            $payment = Payment::select('id', 'parent_id', 'contract_id', 'amount_paid', 'payment_amount','adjusted_amount', 'updated_at')->where(['contract_id' => $contract->id, 'parent_id' => null])->first();
            return [
                'id' => $payment->id,
                'paid' => $payment->amount_paid,
                'total' => $payment->payment_amount,
                'adjusted_amount' => $payment->adjusted_amount ?  $payment->adjusted_amount : 0,
                'remaining' => $payment->payment_amount - $payment->adjusted_amount- $payment->amount_paid,
            ];
        } else {
            return [
                'id' => 0,
                'paid' => 0,
                'total' => 0,
                'adjusted_amount' => 0,
                'remaining' => 0,
            ];
        }
    }
}

if (!function_exists('remaining_quota')) {
    function remaining_quota($id)
    {
        if (ContractsQuota::select('id')->where('id', $id)->exists()) {
            $quota = ContractsQuota::select('id', 'quantity','used','agent_used','assigned')->where('id', $id)->first();
            $total = $quota->quantity + $quota->used + $quota->agent_used + $quota->assigned;
//            $total = $quota->quantity + $quota->used  + $quota->assigned;
            $used  =  $quota->used + $quota->agent_used;
            $remaining = $total - $used;
            return [
                'id' => $id,
                'total' => $total,
                'used' => $used,
                'remaining' => $remaining,
            ];
        }
    }
}


if (!function_exists('property_score')) {
    function property_score($propertyType, $totalImages, $duplicate_images, $totalFeatures, $description)
    {

        //Calculate image Score
        $duplicateImages = $duplicate_images > 0 ? $duplicate_images : 0;
        $totalImages = $totalImages - (int)$duplicateImages;
        if ($propertyType == 'commercial' || $propertyType == 'residential') {
            $imageScore = $totalImages * 2;
        } else { // plot
            $imageScore = ($totalImages * 3) + 1;
        }
        $imageScore = $imageScore > 10 ? 10 : $imageScore;

        // Calculate features  Score
        $totalFeatures = $totalFeatures > 10 ? 10 : $totalFeatures;

        // calculate Description score
        $totalWords = str_word_count($description);
        $totalWordsScore = $totalWords > 0 ? (int)$totalWords / 20 : 0;
        $totalWordsScore = $totalWordsScore > 10 ? 10 : $totalWordsScore;
        // Total score
        $totalScore = $imageScore + $totalFeatures + $totalWordsScore;
         return $totalScore = $totalScore > 30 ? 30 : (int) $totalScore;
       }
}
if (!function_exists('property_logs')) {
    function property_logs($propertyId, $prevData, $newData):void
    {
        $data = [
            'systemUserId' => Str::uuid()->toString(),
            'prevStatus' => json_decode($prevData)->status ?? null,
            'newStatus' => $newData->status ?? null,
            'prevData' => $prevData,
            'newData' => json_encode($newData),
            'propertyId' => $propertyId,
            'crmUserId' => auth()->user()->id ?? 0,
        ];
        PropertyLogs::create($data);
        if($prevData==null){
            \App\Http\Controllers\PackagesController::createCrmLog($propertyId,0,Property::class,"Properties",$prevData,$newData,'create');
        }
    }
}


if (!function_exists('format_features')) {
    function format_features($title)
    {
        return preg_replace('/\B([A-Z])/', ' $1', ucfirst($title));
    }
}
if (!function_exists('selected_option')) {
    function selected_option($option, $selected)
    {
        return $option == $selected ? 'selected' : '';
    }
}
if (!function_exists('agency_types')) {
    function agency_types(): array
    {
        return array(
            "agency" => "Agency",
            "developer" => "Developer",
            "marketing_agency" => "Marketing Agency",
            "individual" => "Individual"
        );
    }
}

if (!function_exists('agency_statuses')) {
    function agency_statuses(): array
    {
        return array(
            'draft' => 'Draft',
            'pending_approval' => 'Pending Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'active' => 'Active',
            'inactive' => 'Inactive',
        );
    }
}

if (!function_exists('crm_date_format')) {
    function crm_date_format($dateTime, $isDate = false): string
    {
        if (!empty($dateTime)) {
            return \Carbon\Carbon::parse($dateTime)->format($isDate ? 'Y-m-d' : 'Y-m-d H:i:s');
        }
        return 'N/A';
    }

}

if (!function_exists('mwsTitle')) {
    function mwsTitle()
    {
        $url = request()->url();
        dd($url);
    }
}


if (!function_exists('priceIntoWords')) {
    function priceIntoWords($value)
    {
        if ($value >= 10000000) {
            return number_format($value / 10000000, 2) . ' crore';
        } elseif ($value >= 100000) {
            return number_format($value / 100000, 2) . ' lac';
        } else {
            return number_format($value, 2);
        }
    }
}

if (!function_exists('getAgenciesByRole')) {
    function getAgenciesByRole()
    {
        $user = Auth::user();
        if ($user->role_id == 1) {
            $agencies = Agency::query();
        } else {
            //$area_agency = \App\Models\AssignUserAgency::where('user_id', $user->id)->first();
            //$user_agency = AssignUserAgency::where('user_id', $user->id)

            $user_agencies = auth()->user()->user_agencies()->pluck('agency_id')->all();
            $agencies = Agency::whereIn('id', $user_agencies);
           // $agencies = Agency::where('assigned_user_id', $user->id);
        }
        return $agencies;
    }
}

if (!function_exists('mwsUuid')) {
    function mwsUuid(): string
    {
        return sprintf('%04x%04x_%04x_%04x_%04x_%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}

if (!function_exists('s3Url')) {
    function s3Url($filename): string
    {
        try {
            //if ($filename != "" && str_contains($filename, 's3.amazonaws.com')) {
            //return $filename;
            //} else {
            // Assuming the S3 bucket URL structure, you may need to adjust it.
            //$s3BaseUrl = 'https://your-s3-bucket.s3.amazonaws.com/';
            //$s3BaseUrl = 'https://graana-blog-images.s3.amazonaws.com/';
            // https://graana-blog-images.s3.amazonaws.com/blog.graana.rocks/wp-content/uploads/2022/12/29051012/screenshot-420x204.jpg

            // Append the filename to the S3 base URL to generate the S3 URL.
            //$s3Url = $s3BaseUrl . $filename;

            //return $s3Url;
            return $filename;
            //}
        } catch (\Throwable $e) {
            //return 'Unable to Get File..'.$e->getMessage();
            return '';
        }
    }
}

if (!function_exists('agencyParam')) {
    function agencyParam($agency)
    {
        $displayValue = "";
        if (empty($agency)) {
            return '';
        }
        if ($agency->name == "") {
            $displayValue = "N/A - " . $agency->id;
        } else {
            $displayValue = $agency->name . ' - ' . $agency->id;
        }
        if ($displayValue) {
            return $displayValue;
        } else {
            return 'N/A';
        }
    }
}
if (!function_exists('userParam')) {
    function userParam($user, $role_id)
    {
        $rolee = Role::where('id', $role_id)->first();
        $role = $rolee->name;

        $displayValue = $user->name . ' - ' . $user->id . ' - ' . $role;
        if ($displayValue) {
            return $displayValue;
        } else {
            return 'N/A';
        }
    }
}

if (!function_exists('getAgenciesArea')) {
    function getAgenciesArea($agency)
    {
        $areas = [];
        if ($agency) {
            foreach ($agency->agency_areas as $area) {
                if (!empty($area->area->name)) {
                    $areas[] = $area->area->name ?? '';
                }
            }
        }
        return implode(',', $areas);
    }
}
if (!function_exists('is_city_has_agency_assign')){
    function is_city_has_agency_assign($userId,$cityId,$typeColumn):bool
    {
        $tableAssignAgency = TableName(\App\Models\AssignUserAgency::class);
        $tableAgency = TableName(\App\Models\Agency::class);
        $area_agency = \App\Models\AssignUserAgency::from($tableAssignAgency." as ".$tableAssignAgency)
            ->join($tableAgency." as ".$tableAgency,$tableAgency.'.id','=',$tableAssignAgency.".agency_id")
            ->where($tableAssignAgency.'.'.$typeColumn,$cityId)
            ->where($tableAssignAgency.'.user_id', $userId)
            ->first();
        return (bool) $area_agency;
    }
}

if (!function_exists('is_area_has_agency')) {
    function is_area_has_agency($userId, $areaId): bool
    {
        $tableAssignAgency = TableName(\App\Models\AssignUserAgency::class);
        $tableAgency = TableName(\App\Models\Agency::class);
        $area_agency = \App\Models\AssignUserAgency::from($tableAssignAgency." as ".$tableAssignAgency)
            ->join($tableAgency." as ".$tableAgency,$tableAgency.'.id','=',$tableAssignAgency.".agency_id")
            ->where($tableAgency.'.area_id',$areaId)
            ->where($tableAssignAgency.'.user_id', $userId)
            ->first();
        return (bool) $area_agency;
    }
}
if (!function_exists('is_area_has_agency_array')) {
    function is_area_has_agency_array($userId, $areaIds=[-1]): bool
    {
        $tableAssignAgency = TableName(\App\Models\AssignUserAgency::class);
        $tableAgency = TableName(\App\Models\Agency::class);
        $area_agency = \App\Models\AssignUserAgency::from($tableAssignAgency." as ".$tableAssignAgency)
            ->join($tableAgency." as ".$tableAgency,$tableAgency.'.id','=',$tableAssignAgency.".agency_id")
            ->whereIn($tableAgency.'.area_id',$areaIds)
            ->where($tableAssignAgency.'.user_id', $userId)
            ->first();
        return (bool) $area_agency;
    }
}

if (!function_exists('is_area_ids_has_agency')) {
    function is_area_ids_has_agency($userId, $area_ids): bool
    {
        $area_ids = json_decode($area_ids, true);

        $tableAssignAgency = TableName(\App\Models\AssignUserAgency::class);
        $tableAgency = TableName(\App\Models\Agency::class);
        $area_agency = \App\Models\AssignUserAgency::from($tableAssignAgency." as ".$tableAssignAgency)
            ->join($tableAgency." as ".$tableAgency,$tableAgency.'.id','=',$tableAssignAgency.".agency_id")
            ->whereIn($tableAgency.'.area_id',$area_ids)
            ->where($tableAssignAgency.'.user_id', $userId)
            ->first();
        return (bool) $area_agency;
       /* $area_agency = \App\Models\AssignUserAgency::where('user_id', $userId)->first();
        if ($area_agency) {
            $agency = Agency::find($area_agency->agency_id);
            if ($agency) {
                return (bool)$agency->agency_areas()
                    ->whereIn('area_id', $area_ids)->get();
            }
        }
        return false;*/
    }
}
if (!function_exists('is_user_has_agency')) {
    function is_user_has_agency($userId): bool
    {
        $area_agency = \App\Models\AssignUserAgency::where('user_id', $userId)->first();
        return (bool)$area_agency;
    }
}
if (!function_exists('searchValueAndReturnNextKey')) {
    function searchValueAndReturnNextKey($searchValue, $array)
    {
        $found = false;
        $nextKey = null;
        $firstKey = null;

        foreach ($array as $key => $value) {
            if ($found) {
                $nextKey = $key;
                break;
            }

            if ($value === $searchValue) {
                $found = true;
            }

            if ($firstKey === null) {
                $firstKey = $key;
            }
        }

        // If the value is found and it is the last element, return the first key
        if ($found && $nextKey === null) {
            $nextKey = $firstKey;
        }

        return $nextKey;
    }
}

if (!function_exists('isRoleAdminSales')) {
    function isRoleAdminSales($role): bool
    {
        if (!empty($role) && $role->slug === 'admin-sales') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleAdminOperation')) {
    function isRoleAdminOperation($role): bool
    {
        if (!empty($role) && $role->slug === 'admin-operations') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleAccountManager')) {
    function isRoleAccountManager($role): bool
    {
        if (!empty($role) && $role->slug === 'account-manager') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleTeleSales')) {
    function isRoleTeleSales($role): bool
    {
        if (!empty($role) && $role->slug === 'telesales') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleAgencyApprover')) {
    function isRoleAgencyApprover($role): bool
    {
        if (!empty($role) && $role->slug === 'agency-approver') {
            return true;
        }
        return false;
    }
}

if (!function_exists('isRoleLeechCaller')) {
    function isRoleLeechCaller($role): bool
    {
        if (!empty($role) && $role->slug === 'leech-caller') {
            return true;
        }
        return false;
    }
}

if (!function_exists('isRolePackageSelector')) {
    function isRolePackageSelector($role): bool
    {
        if (!empty($role) && $role->slug === 'package-selector') {
            return true;
        }
        return false;
    }
}

if (!function_exists('isRoleFinance')) {
    function isRoleFinance($role): bool
    {
        if (!empty($role) && $role->slug === 'finance-hq') {
            return true;
        }
        return false;
    }
}

if (!function_exists('isRoleAreaManagerSales')) {
    function isRoleAreaManagerSales($role): bool
    {
        if (!empty($role) && $role->slug === 'area-manager-sales') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleMediaAssociateRider')) {
    function isRoleMediaAssociateRider($role): bool
    {
        if (!empty($role) && $role->slug === 'media-associate-rider') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleDataEntry')) {
    function isRoleDataEntry($role): bool
    {
        if (!empty($role) && $role->slug === 'data-entry') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleListingReviewer')) {
    function isRoleListingReviewer($role): bool
    {
        if (!empty($role) && $role->slug === 'listing-reviewer') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleSuperAdmin')) {
    function isRoleSuperAdmin($role): bool
    {
        if (!empty($role) && $role->slug === 'super-admin') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleAreaManagerOperations')) {
    function isRoleAreaManagerOperations($role): bool
    {
        if (!empty($role) && $role->slug === 'area-manager-operations') {
            return true;
        }
        return false;
    }
}
if (!function_exists('getUserAreas')) {
    function getUserAreas($user)
    {
        $user_areas = UserArea::select('area_id')
                        ->where('user_id', $user->id)
                        ->pluck('area_id')
                        ->all();

        return $user_areas;
    }
}
if (!function_exists('getUserAgencies')) {
    function getUserAgencies($user)
    {
        $user_agencies = AssignUserAgency::select('agency_id')
            ->where('user_id', $user->id)
            ->pluck('agency_id')
            ->all();

        return $user_agencies;
    }
}
if (!function_exists('getDepartments')) {
    function getDepartments($role='')
    {
        $departmentId = '';
        if (isRoleAdminSales($role)) {
            $departmentId = $role->department_id;
        }
        if (isRoleAdminOperation($role)) {
            $departmentId = $role->department_id;
        }
        if (isRoleAreaManagerSales($role)) {
            $departmentId = $role->department_id;
        }
        if (isRoleAreaManagerOperations($role)) {
            $departmentId = $role->department_id;
        }


        $departments = Department::select('*');
        if ($departmentId) {
            $departments = $departments->where('id', $departmentId);
        }
        if ($role){
            return  \Illuminate\Support\Facades\Cache::remember('department_'.$role->id,now()->addHours(2),function ()use($departments){
                return $departments->get();
            });
        }
        return  \Illuminate\Support\Facades\Cache::remember('departments',now()->addHours(2),function ()use($departments){
          return $departments->get();
        });
    }
}


if (!function_exists('isVideoInterview')) {
    function isVideoInterview($agencyId)
    {
        return isQuotaAvailable($agencyId ,10);
    }
}

if(!function_exists('isQuotaAvailable')) {
    function isQuotaAvailable($agencyId ,$addonID): bool //
    {
        if(ContractsQuota::from(TableName(ContractsQuota::class) . " as quota")
            ->join(TableName(Contract::class) . " as contracts", function ($join) use ($agencyId,$addonID) {
                $join->on('contracts.id', '=', 'quota.contract_id')
                    ->where('contracts.agency_id', $agencyId)
                    ->where('contracts.status', 'active')
                    ->where('quota.addons_id', $addonID)
                    ->where('quota.quantity', '>', 0);
            })
            ->orderBy('contracts.end_date')
            ->exists()){
            return true;
        }else{
            return false;
        }


//        $contracts = Contract::where('agency_id', $agencyId)->where('status', 'active')->orderBy('end_date')->get();
//        if($contracts){
//            foreach($contracts as $contract){
//                $contractQuota  = ContractsQuota::where(['agency_id'=>$agencyId,'contract_id' => $contract->id,'addons_id' => $addonID])
//                    ->where('quantity','>',0)->first();
//                if ($contractQuota) {
//                    return true;
//                }
//            }
//        }
//        return false;
    }
}

if (!function_exists('mws_price_category')) {
    function mws_price_category(): array
    {
        return [
            'fairPrice' => 'Fair Price',
            'aboveMarketPrice' => 'Above Market Price',
            'belowMarketPrice' => 'Below Market Price',
            'unrealisticPrice' => 'Unrealistic Price',
        ];
    }
}

if (!function_exists('getPropertiesStatus')) {
    function getPropertiesStatus():array
    {
        return [
            'draft'         =>  'Draft',
            'pending'       =>  'Pending',
            'published'     =>  'Published',
            'rejected'      =>  'Rejected',
            'inprogress'    =>  'In Progress',
            'rented'        =>  'Rented',
            'removed'       =>  'Removed',
            'closed'        =>  'Closed',
            'sold'          =>  'Sold',

        ];
    }
}
if (!function_exists('UpdateListingContractId')) {
    function UpdateListingContractId($oldCid, $newCid,$availableQuoata,$category)
    {
        $agentListing =0;
        $ownerListing =0;
        $contract = Contract::select('id','end_date')->where('id', $newCid)->first();
        $end_date = Carbon::createFromFormat('Y-m-d', $contract->end_date);
        $currentDate = Carbon::today();
        $totalDays = $currentDate->diffInDays($end_date);// calculate remainig days in end date
        if ($totalDays > 180) { // if remaining days greater than 180 days
            $currentDate = Carbon::today();
            $format_date = $currentDate->copy()->addMonths(6);
            $prop_expired_date = $format_date->format('Y-m-d');
        } else {
            $prop_expired_date = $contract->end_date;
        }
        $properties = Property::from(TableName(Property::class) . " as properties")
            ->leftjoin(TableName(UsersMappings::class) . " as usersMappings", 'properties.userId', '=', 'usersMappings.uuid')
            ->select( 'properties.status as status'
                ,'properties.id as id'
                ,'properties.contractId as contractId'
                ,'properties.expiresAt as expiresAt'
                ,'usersMappings.role as role'
                ,'usersMappings.agencyId as agencyId'
            )
            ->where('properties.contractId', $oldCid)
            ->whereNotIn('properties.status', ["rejected", "removed"])
            ->orderBy('properties.expiresAt')
            ->take($availableQuoata) // move according to the available Quotas
            ->get();
        if ($properties) {
            foreach ($properties as $property) {
                if($property->role == 'agent'){
                    $agentListing++;
                    if($category=='upsell'){
                        $mapping = UsersMappings::where(['agencyId' => $property->agencyId,'role'=> 'agencyOwner'])->first();
                        $data = [
                            'userId'=> $mapping->uuid,
                            'agentId'=> $mapping->uuid,
                            'contractId' => $newCid,
                            'expiresAt' => $prop_expired_date,
                        ];
                    }else{
                        $data = [
                            'contractId' => $newCid,
                            'expiresAt' => $prop_expired_date,
                        ];
                    }
                }else{
                    $ownerListing++;
                    $data = [
                        'contractId' => $newCid,
                        'expiresAt' => $prop_expired_date,
                    ];
                }
                $property->update($data);
                ContractProperties::create([
                    'contract_id' => $newCid,
                    'property_id' => $property->id,
                ]);
            }
        }
        return ['ownerQuota' => $ownerListing , 'agentQuota' => $agentListing];
    }
}

if (!function_exists('mwsGetUserName')){
    function mwsGetUserName($userId):string{
        $user = User::find($userId);
        if ($user){
            return userParam($user,$user->role_id);
        }
        return 'N/A';
    }
}
if (!function_exists('send_email')){ // Email Notifications
    function send_email($to,$subject,$text,$cc){
        try {
            Http::post(env('OTP_API_URL') . "email", [
                'to'=> $to,
                'subject'=> $subject,
                'text'=> $text,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'   =>false,
                'message' => 'An error occurred while sending the Email'
            ], 400);
        }
    }
}
if (!function_exists('send_email_html')){ // Email Notifications
    function send_email_html($to,$subject,$text,$cc){
        try {
            Http::post(env('OTP_API_URL') . "email", [
                'to'=> $to,
                'subject'=> $subject,
                'text'=> $text,
                'isHtml'    =>  true,
                'html'      =>  $text
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'   =>false,
                'message' => 'An error occurred while sending the Email'
            ], 400);
        }
    }
}

if(!function_exists('send_message')){ //Message Notifications
    function send_message($phoneNo,$message){
        try {
            Http::post(env('OTP_API_URL') . "phone/message", [
                'phone_number' => $phoneNo,
                'phone_message' => $message,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'   =>false,
                'message' => 'An error occurred while sending the message'
            ], 400);
        }
    }
}


if (!function_exists('crm_notifications')){
    function crm_notifications(){
        if (!empty(\auth()->user())){
            return   \App\Models\CRMNotification::where('user_id',auth()->id())->where('is_read',false)->orderBy('id','desc')->get();
        }
        return [];
    }
}

if(!function_exists('addWatermark')){
    function addWatermark(Request $request,$image){
        //$image = $request->file('image');

        // Define the path to your watermark image
        $watermarkPath = public_path('images/contract/347392553_649889817182092_6130253570096248523_n.jpg');

        // Open and manipulate the image
        $img = Image::make($image);

        // Add the watermark to the image
        $img->insert($watermarkPath, 'bottom-right', 10, 10);

        // Save the image with the watermark
        //$img->save(public_path('images/watermarked.jpg'));

        return $img;
      //  return 'Watermark added successfully!';
    }

    function truncateString($text, $maxlength, $dots = true) {
        if(strlen($text) > $maxlength) {
            if ( $dots ) return substr($text, 0, ($maxlength - 3)) . '...';
            else return substr($text, 0, ($maxlength - 3));
        } else {
            return $text;
        }
    }
}

if (!function_exists('grace_time')) {
    function grace_time(): array
    {
        $graceTime = GraceTime::find(1);
        return array(
            'payment' => $graceTime->payment??0,
            'contract' => $graceTime->contract??0,
        );
    }
}
if (!function_exists('isRolePersonalDataVisible')) {
    function isRolePersonalDataVisible($role): bool
    {
        $data=$role->role_data_visibility;
        return $data && $data->personal ? true :false;
    }
}
if (!function_exists('isRoleTeamDataVisible')) {
    function isRoleTeamDataVisible($role): bool
    {
        $data=$role->role_data_visibility;
        return $data && $data->team ? true :false;
    }
}
if (!function_exists('isRoleAssignAgencyDataVisible')) {
    function isRoleAssignAgencyDataVisible($role): bool
    {
        $data=$role->role_data_visibility;
        return $data && $data->assign_agency ? true :false;
    }
}
if (!function_exists('isRoleAssignAreaDataVisible')) {
    function isRoleAssignAreaDataVisible($role): bool
    {
        $data=$role->role_data_visibility;
        return $data && $data->assign_area ? true :false;
    }
}

if (!function_exists('datatables_pagination_length')){
    function datatables_pagination_length():int
    {
        return 10;
    }
}
if (!function_exists('datatables_scroller')){
    function datatables_scroller():array
    {
        return [
            'scrollCollapse'    =>  false,
            'scrollY'           =>  '50vh'
        ];
    }
}

if (!function_exists('datatables_lengthMenu')){
    function datatables_lengthMenu():array
    {
        return [10,20,30,40, 50,60, 70,80,90, 100];
    }
}
