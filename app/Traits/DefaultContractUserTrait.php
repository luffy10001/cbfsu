<?php

namespace App\Traits;

use App\Models\Agency;
use App\Models\Contract;
use App\Models\Package;
use App\Models\PackageItem;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use File;

trait DefaultContractUserTrait
{
    protected function defaultContractUser($agency_id = null)
    {
        $current_dt = Carbon::now()->toDateTimeString();
        if ($agency_id) {
            $default_package = Package::with('package_items')->where('is_default', true)->first();
            if ($default_package) {
                $data = [
                    'agency_id' => $agency_id,
                    'package_id' => $default_package['id'],
                    'duration' => 1,
                    'sign_date' => $current_dt,
                    'start_date' => $current_dt,
                    'end_date' => Carbon::parse($current_dt)->addMonths(1)->toDateTimeString(),
                    'category' => 'New',
                    'foc' => 0,
                    'status' => 'active',
                    'is_notify' => false
                ];
                $contract = Contract::create($data);
                if ($contract) {
                    return $contract;
                }
            }
        }
        return [];
    }

    public static function createContractPackage($request, $current_time, $contractObj, $agency)
    {
        $package = Package::where('is_default', true)->first();
        if ($package) {
            $package_items = PackageItem::where('package_id', $package['id'])->get();
            //// adding keys to use in trait for Contract creation
            $request->merge([
                'start_date' => $current_time,
                'agency_id' => $agency['id'],
                'data_from' => 'api',
                'package_id' => $package['id'],
            ]);
            foreach ($package_items as $item) {
                self::create_default_contract_items_and_adons($request, $item, (object) $contractObj);
            }
            $request->merge([
                'contract_id'   => $contractObj->id,
                'status'        => 'approved',
                'agency_id'     => $agency['id'],
                'data_from'     => 'api',
                'amount_paid'   =>  0
            ]);
            $paymentObj = self::createPayment($request);
            return true;
        }
    }

    private static function defaultPackageAssign($agencyId):void
    {
        $request    =   request();
        $agency     =   Agency::find($agencyId);
        if ($agency)
        {
            $package = Package::where('is_default', true)->first();
            if ($package){
                $data = [
                    'agency_id' => $agencyId,
                    'package_id' => $package->id,
                    'duration' => 1,
                    'sign_date' => date('Y-m-d H:i:s'),
                    'start_date' => date('Y-m-d H:i:s'),
                    'end_date' => Carbon::parse(date('Y-m-d H:i:s'))->addMonths(1)->toDateTimeString(),
                    'category' => 'New',
                    'foc' => 0,
                    'status' => 'active',
                    'is_notify' => false
                ];
                $contract = Contract::create($data);
                $package_items = PackageItem::where('package_id', $package['id'])->get();
                //// adding keys to use in trait for Contract creation
                $request->merge([
                    'start_date' => date('Y-m-d H:i:s'),
                    'package_id'   =>  $package->id,
                    'agency_id' => $agencyId,
                    'data_from' => 'api'
                ]);
                foreach ($package_items as $item) {
                    self::create_contract_items_and_adons($request, $item, (object)$contract);
                }
            }
        }
    }
}
