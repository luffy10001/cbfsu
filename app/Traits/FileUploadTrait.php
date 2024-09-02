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
            if ($directory == "")
            {
                return array( 'success' => FALSE, 'message' => 'Directory is empty.' );
            }

            $path = public_path($directory);
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

            $newFile =  $path.$file->getClientOriginalName();
            $extension = pathinfo($newFile,PATHINFO_EXTENSION);
            $filename = pathinfo($newFile, PATHINFO_FILENAME);
            $duplicateCounter = 1;
            if(file_exists($newFile))
            {
                while(file_exists($iterativeFileName = $path ."/". $filename ."_". $duplicateCounter .".". $extension)) {
                    $duplicateCounter++;
                }
                $newFile = $iterativeFileName;
            }
            $newname = pathinfo($newFile, PATHINFO_FILENAME);
            $newfilename = $newname.".".$extension;
            if($file->move($path, $newFile))
            {
                return array( 'success' => TRUE, 'filename' => $newfilename, 'filepath' => $directory.$newfilename );
            };
            return array( 'success' => FALSE, 'message' => 'Sorry! Unable to Uplaod File.' );
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