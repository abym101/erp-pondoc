<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeServiceCommand extends Command
{
    protected $signature =
        'make:service {name}';

    protected $description =
        'Create a service class';

    public function handle()
    {
        $name =
            $this->argument('name');
        $dir =
            app_path('Services');
        if (! is_dir($dir)) {
            mkdir(
                $dir,
                0777,
                true
            );
        }
        $file =
            $dir.'/'.$name.'.php';
        if (file_exists($file)) {
            $this->error(
                'Service already exists.'
            );

            return self::FAILURE;
        }
        $stub = "<?php
namespace App\Services;
class {$name}
{
}
";
        file_put_contents(
            $file,
            $stub
        );
        $this->info(
            'Service created: '.$file
        );

        return self::SUCCESS;
    }
}
