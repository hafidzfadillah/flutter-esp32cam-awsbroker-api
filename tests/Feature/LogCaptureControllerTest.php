<?php

// tests/Feature/LogCaptureControllerTest.php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LogCaptureControllerTest extends TestCase
{

    public function testLogCaptureStore()
    {
        // Inside your test setup or at the beginning of the test method
        Config::set('filesystems.disks.gcs', [
            'driver' => 'gcs',
            'key_file' => env('GOOGLE_CLOUD_STORAGE_KEY_PATH'), // Use your environment variable or specify the path directly
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID'),
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET_NAME'),
        ]);
        Storage::fake('gcs');

        $imageFile = UploadedFile::fake()->image('test_image.jpg');

        // Output the path and content of the generated file for debugging
    dump($imageFile->getPathname());
    dump(file_get_contents($imageFile->getPathname()));

        $response = $this->post('/api/log-capture', [
            'image' => $imageFile,
            'capture_by' => 'John Doe',
        ]);

        dump($response->getContent());

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'status',
            'image_url',
            'message',
        ]);

        $imageUrl = json_decode($response->getContent())->image_url;

        // Assert that the file was uploaded to GCS
        $exists = Storage::disk('gcs')->exists($imageUrl);
        $this->assertTrue($exists, 'The file does not exist in Google Cloud Storage.');

        // Optionally, you can assert the database record as well
        $this->assertDatabaseHas('log_captures', [
            'image_url' => $imageUrl,
            'capture_by' => 'John Doe',
        ]);
    }
}
?>
