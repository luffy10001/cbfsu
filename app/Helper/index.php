<?php

use App\Mail\GeneralMail;
use App\Models\Agency;
use App\Models\AssignUserAgency;
use App\Models\ContractProperties;
use App\Models\Department;
use App\Models\User;
use App\Models\Notification;
use App\Models\Role;
use App\Models\UserArea;
use App\Models\UsersMappings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ContractsQuota;
use App\Models\Payment;
use App\Models\PropertyLogs;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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


if (!function_exists('selected_option')) {
    function selected_option($option, $selected)
    {
        return $option == $selected ? 'selected' : '';
    }
}

if (!function_exists('positions')) {
    function positions(): array
    {
        return array(
            '1' => 'First-Time Customer',
            '2' => 'Returning Customer',
            '3' => 'High-Value Customer',
            '4' => 'Occasional Customer',
            '5' => 'Active Customer',
            '6' => 'Inactive Customer',
        );
    }
}
if (!function_exists('corporation_types')) {
    function corporation_types()
    {
        return array(
            '1' => 'Public Corporation',
            '2' => 'Private Corporation',
            '3' => 'Nonprofit Corporation',
        );
    }
}
if (!function_exists('am_best_rating')) { // added here for easily change in future
    function am_best_rating(): array
    {
        return array(
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
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

if (!function_exists('isRoleSuperAdmin')) {
    function isRoleSuperAdmin($role): bool
    {
        if (!empty($role) && $role->slug === 'super-admin') {
            return true;
        }
        return false;
    }
}
if (!function_exists('isRoleCustomer')) {
    function isRoleCustomer($role): bool
    {
        if (!empty($role) && $role->slug === 'customer') {
            return true;
        }
        return false;
    }
}
if (!function_exists('toAdmin')) {
    function toAdmin()
    {
        $user = User::from(TableName(User::class).' as user')
            ->leftJoin(TableName(Role::class).' as role','user.role_id','=','role.id')
            ->where('role.slug','super-admin')
            ->select('user.*')
            ->first();
        return $user;
    }
}
if (!function_exists('send_email')){ // Email Notifications
    function send_email($to,$subject,$text,$cc,$page_route_name,$toName){
        try {
            $mail_data= [
                'subject' => $subject,
                'message' => $text,
                'name'    => $toName,
                'url'     => $page_route_name

            ];

            Mail::to($to)->send(new GeneralMail($mail_data,'Notification'));
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

if (!function_exists('date_formats')) {
    function date_formats($dateTime, $isDate = false): string
    {
        if (!empty($dateTime)) {
            return \Carbon\Carbon::parse($dateTime)->format($isDate ? 'Y-m-d' : 'Y-m-d H:i:s');
        }
        return 'N/A';
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


if (!function_exists('days_unit')) {
    function days_unit(): array
    {
        return array(
            '1'=>'Years',
            '2'=>'Months',
            '3'=>'Weeks',
            '4'=>'Days',
        );
    }
}

if (!function_exists('territory_units')) {
    function territory_units(): array
    {
        return array(
            '1'=>'Miles',
            '2'=>'Yards',
            '3'=>'Kilometers',
            '4'=>'Meters',
        );
    }
}
if (!function_exists('notifications')){
    function notifications(){
        if (!empty(\auth()->user())){
            return Notification::where('user_id',auth()->id())->where('is_read',false)->orderBy('id','desc')->get();
        }
        return [];
    }
}
