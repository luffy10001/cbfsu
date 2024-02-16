<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Contract;
use App\Models\AgencyAttachment;
use App\Models\AgencyPocAttachement;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class CloudinaryUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('max_execution_time', -1);
        //agency table's update
        $result = Agency::whereRaw("card_shop_image NOT LIKE CONCAT('%cloudinary.com%')")
            ->get();
        if($result->count() > 0)
        {
            $result = $result->toArray();
        }

        foreach ($result as $row)
        {
            if($row['card_shop_image'])
            {
                $url = s3Url($row['card_shop_image']);
                if (isset($url) && $url != "") {
                    $row['card_shop_image'] = $url;

                    if ($row['id']) {
                        $update = Agency::where('id', $row['id'])->update($row);
                    }
                }
            }
        }

        //contract table's update starts
        $result = Contract::whereRaw("attachment NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("pdf_file NOT LIKE CONCAT('%cloudinary.com%')")
            ->get();
        if($result->count() > 0)
        {
            $result = $result->toArray();
        }

        foreach ($result as $row)
        {
            if($row['attachment'])
            {
                $url = s3Url($row['attachment']);
                if(isset($url) && $url!="")
                {
                    $row['attachment'] = $url;

                    if($row['id'])
                    {
                        $update = Contract::where('id', $row['id'])->update($row);
                    }
                }
            }
        }

        foreach ($result as $row)
        {
            if($row['pdf_file'])
            {
                $url = s3Url($row['pdf_file']);
                if (isset($url) && $url != "") {
                    $row['pdf_file'] = $url;

                    if ($row['id']) {
                        $update = Contract::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        //contract table's update Ends

        //payment table's update starts
        $result = Payment::whereRaw("cash_deposit_slip NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("online_screenshot NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("cheque_image NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("cheque_deposit_slip NOT LIKE CONCAT('%cloudinary.com%')")
            ->get();
        if($result->count() > 0)
        {
            $result = $result->toArray();
        }

        foreach ($result as $row)
        {
            if($row['cash_deposit_slip'])
            {
                $url = s3Url($row['cash_deposit_slip']);
                if(isset($url) && $url!="")
                {
                    $row['cash_deposit_slip'] = $url;

                    if($row['id'])
                    {
                        $update = Payment::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        foreach ($result as $row)
        {
            if($row['online_screenshot'])
            {
                $url = s3Url($row['online_screenshot']);
                if(isset($url) && $url!="")
                {
                    $row['online_screenshot'] = $url;

                    if($row['id'])
                    {
                        $update = Payment::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        foreach ($result as $row)
        {
            if($row['cheque_image'])
            {
                $url = s3Url($row['cheque_image']);
                if(isset($url) && $url!="")
                {
                    $row['cheque_image'] = $url;

                    if($row['id'])
                    {
                        $update = Payment::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        foreach ($result as $row)
        {
            if($row['cheque_deposit_slip'])
            {
                $url = s3Url($row['cheque_deposit_slip']);
                if(isset($url) && $url!="")
                {
                    $row['cheque_deposit_slip'] = $url;

                    if($row['id'])
                    {
                        $update = Payment::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        //payment table's update ends

        //agency table's update starts
        $result = Agency::whereRaw("owner_picture NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("logo_image NOT LIKE CONCAT('%cloudinary.com%')")
            ->get();
        if($result->count() > 0)
        {
            $result = $result->toArray();
        }

        foreach ($result as $row)
        {
            if($row['owner_picture'])
            {
                $url = s3Url($row['owner_picture']);
                if (isset($url) && $url != "") {
                    $row['owner_picture'] = $url;

                    if ($row['id']) {
                        $update = Agency::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        foreach ($result as $row)
        {
            if($row['logo_image'])
            {
                $url = s3Url($row['logo_image']);
                if (isset($url) && $url != "") {
                    $row['logo_image'] = $url;

                    if ($row['id']) {
                        $update = Agency::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        //agency table's update ends

        //agency_attachement table's update starts
        $result = AgencyAttachment::whereRaw("file_name NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("url NOT LIKE CONCAT('%cloudinary.com%')")
            ->get();
        if($result->count() > 0)
        {
            $result = $result->toArray();
        }

        foreach ($result as $row)
        {
            if($row['file_name'])
            {
                $url = s3Url($row['file_name']);
                if (isset($url) && $url != "") {
                    $row['file_name'] = $url;

                    if ($row['id']) {
                        $update = AgencyAttachment::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        foreach ($result as $row)
        {
            if($row['url'])
            {
                $url = s3Url($row['url']);
                if (isset($url) && $url != "") {
                    $row['url'] = $url;

                    if ($row['id']) {
                        $update = AgencyAttachment::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        //agency_attachement table's update ends

        //agency_poc_attachement table's update starts
        $result = AgencyPocAttachement::whereRaw("file_name NOT LIKE CONCAT('%cloudinary.com%')")
            ->orWhereRaw("url NOT LIKE CONCAT('%cloudinary.com%')")
            ->get();
        if($result->count() > 0)
        {
            $result = $result->toArray();
        }

        foreach ($result as $row)
        {
            if($row['file_name'])
            {
                $url = s3Url($row['file_name']);
                if (isset($url) && $url != "") {
                    $row['file_name'] = $url;

                    if ($row['id']) {
                        $update = AgencyPocAttachement::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        foreach ($result as $row)
        {
            if($row['url'])
            {
                $url = s3Url($row['url']);
                if (isset($url) && $url != "") {
                    $row['url'] = $url;

                    if ($row['id']) {
                        $update = AgencyPocAttachement::where('id', $row['id'])->update($row);
                    }
                }
            }
        }
        //agency_poc_attachement table's update ends

    }
}