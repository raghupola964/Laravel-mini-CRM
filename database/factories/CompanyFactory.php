<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        $minHeight = 100;
        $minWidth = 100;
        $maxWidth = 640;
        $maxHeight = 480;

        $width = $this->faker->numberBetween($minWidth, $maxWidth);
        $height = $this->faker->numberBetween($minHeight, $maxHeight);

        $directory = storage_path('app/public/logos');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
            Log::info("Created directory: $directory");
        }
        if (!is_writable($directory)) {
            Log::error("Directory not writable: $directory");
            chmod($directory, 0755);
        }

        // Generate a simple colored image locally
        $filename = $this->faker->uuid . '.jpg'; // Unique filename
        $fullPath = $directory . '/' . $filename;

        try {
            $image = imagecreatetruecolor($width, $height);
            if ($image === false) {
                throw new \Exception('Failed to create image resource');
            }
            // Random background color
            $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagefill($image, 0, 0, $color);
            // Save the image
            if (!imagejpeg($image, $fullPath)) {
                throw new \Exception('Failed to save image');
            }
            imagedestroy($image);
            Log::info("Image generated: $fullPath");
            $imagePath = $filename;
        } catch (\Exception $e) {
            $imagePath = null;
            Log::error('Image generation failed: ' . $e->getMessage() . ' | GD enabled: ' . (extension_loaded('gd') ? 'Yes' : 'No'));
        }

        return [
            'name' => $this->faker->company,
            'email' => $this->faker->companyEmail,
            'logo' => $imagePath ? 'logos/' . $imagePath : null,
            'website' => $this->faker->url,
        ];
    }
}