<?php

namespace App\Services;

use Google\Cloud\Storage\StorageClient;

class ImageUploadService
{
    protected $storage;

    public function __construct()
    {
        $keyfilePath = base_path('storage/keys/iot-doorlock-410309-95635c309bb7.json');
        if (!file_exists($keyfilePath)) {
            throw new \Exception("Keyfile does not exist: $keyfilePath");
        }
        // Set up the Google Cloud Storage client
        $this->storage = new StorageClient([
            'projectId' => 'bucket_iot_doorlock2',
            'keyFilePath' => $keyfilePath,
        
        ]);
    }

    public function upload($file, $folder)
    {
        // Generate a unique filename
        $filename = $folder . '/' . uniqid() . '_' . $file->getClientOriginalName();

        // Upload the file to Google Cloud Storage
        $bucket = $this->storage->bucket('bucket_iot_doorlock2');
        $bucket->upload(
            file_get_contents($file->getPathname()),
            ['name' => $filename]
        );

        // Get the public URL of the uploaded file
        $url = 'https://storage.googleapis.com/' . $bucket->name() . '/' . $filename;

        return $url;
    }
}
