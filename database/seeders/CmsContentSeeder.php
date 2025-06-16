<?php

namespace Database\Seeders;

use App\Models\CmsContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {
        $json = file_get_contents(database_path('seeders/cms_data.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            // Skip items that don't have required fields
            if (!isset($item['page'], $item['sectionType'], $item['title'])) {
                continue;
            }

            CmsContent::create([
                'page' => $item['page'],
                'section' => $item['sectionType'],
                'title' => $item['title'],
                'key_name' => isset($item['id']) ? 'field_' . $item['id'] : null,
                'content' => $item['content'] ?? null, // prevent undefined key
                'status' => $item['status'] ?? 'Active',
                'type' => isset($item['isMedia']) ? 'media' : 'text',
                'constraints' => json_encode([
                    'maxLength' => $item['maxLength'] ?? null,
                    'mediaConstraints' => $item['mediaConstraints'] ?? null,
                    'maxLengthConstraints' => $item['maxLengthConstraints'] ?? null,
                ]),
            ]);
        }
    }
}
