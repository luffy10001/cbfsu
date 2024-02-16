<?php

/*
 * This file is part of the Laravel S3 Custom.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'AWS_S3_FOLDER' => env('AWS_FOLDER','crm').'/'.env('APP_ENV','local'),
    'AWS_S3_ACCESS_KEY_ID' => env('AWS_S3_ACCESS_KEY_ID'),
    'AWS_S3_SECRET_ACCESS_KEY' => env('AWS_S3_SECRET_ACCESS_KEY'),
    'AWS_S3_DEFAULT_REGION' => env('AWS_S3_DEFAULT_REGION'),
    'AWS_S3_BUCKET' => env('AWS_S3_BUCKET'),
    'AWS_S3_URL' => env('AWS_S3_URL'),
    'AWS_S3_ENDPOINT' => env('AWS_S3_ENDPOINT'),
    'AWS_S3_USE_PATH_STYLE_ENDPOINT' => env('AWS_S3_USE_PATH_STYLE_ENDPOINT', false),
];