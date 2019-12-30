<?php

namespace Viviniko\Book\Console\Commands;

use Illuminate\Console\Command;

class ImportBookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book:import {url : The url of the book}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import book from given url.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $url = $this->argument('url');
        $fileService = $this->laravel[\Viviniko\Media\Services\FileService::class];
        $file = is_numeric($url) ? $fileService->get($this->argument('url')) : $fileService->parse($this->argument('url'));
        $lines = explode("\n", $file->content);
        $this->info('Url: ' . $url);
        $this->info('Lines: ' . count($lines));
    }
}
