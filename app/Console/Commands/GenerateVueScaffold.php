<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateVueScaffold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // create a signature for the command that takes a name argument and two options (create and edit) with shortcuts c and e respectively
    protected $signature = 'make:vue {name : Name of the model} {--i|index : Create a "Index.vue"} {--c|create : Create a "Create.vue"} {--e|edit : Create a "Edit.vue"} {--f|force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new vue file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $index = $this->option('index');
        $create = $this->option('create');
        $edit = $this->option('edit');
        $force = $this->option('force');

        $this->createVueFile($name,$index, $create, $edit, $force);
    }

    /**
     * Create a new vue file.
     */
    protected function createVueFile(string $name, bool $index = false, bool $create = false, bool $edit = false, bool $force = false)
    {
        $nothingSelected = (!$index && !$create && !$edit);
        if ($index || $nothingSelected) {
            $this->createFile($name, 'Index', $force);
        }

        if ($create || $edit) {
            $this->createFile($name, 'Fields', $force);
        }

        if ($create) {
            $this->createFile($name, 'Create', $force);
        }

        if ($edit) {
            $this->createFile($name, 'Edit', $force);
        }
    }

    private function createFile(string $modelName, string $fileName, bool $force = false)
    {
        $path = resource_path('js/Pages/Model/' . $modelName . '/' . $fileName . '.vue');

        if (file_exists($path) && !$force) {
            $this->error($fileName .' file already exists!');
            return;
        }
        $folder = resource_path('js/Pages/Model/' . $modelName);
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $stub = file_get_contents(base_path('stubs/'.$fileName.'.vue.stub'));
        $name_lowercase = strtolower($modelName);
        $name_uppercase = $modelName;
        $stub = str_replace('{{ name_lowercase }}', $name_lowercase, $stub);
        $stub = str_replace('{{ name_uppercase }}', $name_uppercase, $stub);

        file_put_contents($path, $stub);

        $this->info($fileName .' file created successfully.');
    }
}
