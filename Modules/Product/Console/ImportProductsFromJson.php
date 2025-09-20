<?php

namespace Modules\Product\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Modules\Product\Services\ProductCreator;

class ImportProductsFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import-json {path : Path to JSON file} {--image-template= : URL template with {barcode} placeholder} {--concurrency=5 : Number of concurrent chunks}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from a JSON file and attach images from a URL template (no HTTP submission to app).';

    public function handle(ProductCreator $creator)
    {
        $path = $this->argument('path');
        $template = $this->option('image-template');
        $concurrency = max(1, (int)$this->option('concurrency'));

        if (!File::exists($path)) {
            $this->error("JSON file not found: {$path}");
            return 1;
        }

        $json = json_decode(File::get($path), true);
        if (!is_array($json)) {
            $this->error('Invalid JSON structure. Expecting an array of items.');
            return 1;
        }

        $this->info('Import started. Items: ' . count($json));

        // Preload categories
        $uniqueCategories = [];
        foreach ($json as $item) {
            $code = (string)($item['kode_toko'] ?? '');
            if ($code === '') continue;
            $uniqueCategories[$code] = $code; // name == code
        }

        $this->info('Verifying categories: ' . count($uniqueCategories));
        $categoryIdByCode = [];
        foreach ($uniqueCategories as $code => $name) {
            $category = $creator->getOrCreateCategory($code, $name);
            $categoryIdByCode[$code] = $category->id;
        }

        // Chunk processing to limit memory usage
        $chunks = array_chunk($json, 100);
        $bar = $this->output->createProgressBar(count($json));
        $bar->start();

        foreach ($chunks as $chunk) {
            // Simple concurrency via process forking is overkill; process sequentially within chunk
            foreach ($chunk as $item) {
                $barcode = (string)($item['kode_barcode'] ?? '');
                $categoryCode = (string)($item['kode_toko'] ?? '');
                $categoryId = $categoryIdByCode[$categoryCode] ?? null;
                if (!$categoryId) {
                    $bar->advance();
                    continue;
                }

                $attrs = $creator->mapJsonItemToAttributes($item, $categoryId);

                $imageUrl = null;
                if ($template && $barcode !== '') {
                    $imageUrl = str_replace('{barcode}', $barcode, $template);
                }

                $creator->createProduct($attrs, $imageUrl);
                $bar->advance();
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info('Import finished.');

        return 0;
    }
}


