<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use File;
use Mockery\Exception;

trait FileUploadTrait
{
    /**
     * Upload a file and return the stored path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return array|null
     */
    protected function uploadFile(UploadedFile $file, string $directory = "", $public_id = ''): ?array
    {
        try {
            if (empty($directory)) {
                return ['success' => false, 'message' => 'Directory is empty.'];
            }

            // Generate a unique filename for the S3 bucket
            $filename_new  = strtotime(now()) . '_' . mwsUuid() . '_' . str_replace(" ", '_', $file->getClientOriginalName());

            $crm_dir = \Config::get('s3.AWS_S3_FOLDER').'/' . $directory;
            $crm_dir = trim($crm_dir,'/');

            // Upload the file to S3
            $path = Storage::disk('s3')->putFileAs($crm_dir, $file, $filename_new, 'public');
            if ($path) {
                $url = Storage::disk('s3')->url($path);

                $new_url = AWSS3Link::createS3Link($path);
                if ($new_url){
                    $url = $new_url;
                }

                // If a public_id is provided, delete the previous file on S3
                //if (!empty($public_id)) {
                // You can implement S3 file deletion here if needed
                // }
                return ['success' => true, 'filename' => $url, 'filepath' => $url];
            }

            return ['success' => false, 'message' => 'Sorry! Unable to Upload File...'];
        } catch (\Throwable $e) {

            return ['success' => false, 'message' => 'Sorry! Unable to Upload File..'.$e->getMessage()];
        }
    }
    protected function uploadCustomFile($file, string $directory = "", $public_id = ''): ?array
    {
        try {
            if (empty($directory)) {
                return ['success' => false, 'message' => 'Directory is empty.'];
            }

            // Generate a unique filename for the S3 bucket
            $newfilename = strtotime(now()) . '_' . mwsUuid() . '_';

            // Upload the file to S3
            $path = Storage::disk('s3')->putFileAs('graanacrm/' . $directory, $file, $newfilename, 'public');

            if ($path) {
                // Generate the URL for the uploaded file
                $url = Storage::disk('s3')->url($path);

                // If a public_id is provided, delete the previous file on S3
                // if (!empty($public_id)) {
                // You can implement S3 file deletion here if needed
                // }

                return ['success' => true, 'filename' => $url, 'filepath' => $url];
            }

            return ['success' => false, 'message' => 'Sorry! Unable to Upload File.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => 'Sorry! Unable to Upload File.'];
        }
    }
}