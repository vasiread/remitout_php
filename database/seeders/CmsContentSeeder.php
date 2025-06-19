<?php

namespace Database\Seeders;

use App\Models\CmsContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_contents')->truncate(); // Reset table and auto-increment

        $jsonPath = database_path('seeders/cms_data.json');

        if (!file_exists($jsonPath)) {
            throw new \Exception("File not found: $jsonPath");
        }

        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON decode error: " . json_last_error_msg());
        }

        foreach ($data as $item) {
            // Skip items that don't have required fields
            if (!isset($item['page'], $item['sectionType'], $item['title'])) {
                continue;
            }

            // Handle content: encode array or object as JSON
            $content = $item['content'] ?? null;
            if (is_array($content) || is_object($content)) {
                $content = json_encode($content);
            }

            // Prepare constraints
            $constraints = [
                'maxLength' => $item['maxLength'] ?? null,
                'mediaConstraints' => $item['mediaConstraints'] ?? null,
                'maxLengthConstraints' => $item['maxLengthConstraints'] ?? null,
            ];

            CmsContent::create([
                'page' => $item['page'],
                'section' => $item['sectionType'],
                'title' => $item['title'],
                'key_name' => isset($item['id']) ? 'field_' . $item['id'] : null,
                'content' => $content,
                'status' => $item['status'] ?? 'Active',
                'type' => isset($item['isMedia']) ? 'media' : (isset($item['isTestimonialArray']) ? 'array' : 'text'),
                'constraints' => json_encode($constraints),
            ]);
        }
    }
}
