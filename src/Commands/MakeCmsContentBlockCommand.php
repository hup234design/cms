<?php

namespace Hup234design\Cms\Commands;

use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Filament\Support\Commands\Concerns\CanValidateInput;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeCmsContentBlockCommand extends Command
{
    use CanManipulateFiles;
    use CanValidateInput;

    protected $signature = 'cms:content-block {name?} {--F|force}';

    protected $description = 'Create a new cms content block';

    public function handle(): int
    {
        $contentBlock = (string) Str::of($this->argument('name') ?? $this->askRequired('Name (e.g. `HeroBlock`)', 'name'))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');

        $contentBlockClass = (string) Str::of($contentBlock)->afterLast('\\');

        $name = Str::of($contentBlock)
            //->beforeLast('Block')
            ->explode('\\')
            ->map(fn ($segment) => Str::kebab($segment))
            ->implode('.');

        $view = Str::of($contentBlock)
            //->beforeLast('Block')
            ->prepend('\\')
            ->explode('\\')
            ->map(fn ($segment) => Str::kebab($segment))
            ->implode('.');

        $path = app_path(
            (string) Str::of($contentBlock)
                ->prepend('Http\\Livewire\\')
                ->replace('\\', '/')
                ->append('.php'),
        );

        $viewPath = resource_path(
            (string) Str::of($view)
                ->replace('.', '/')
                ->prepend('views/content-blocks')
                ->append('.blade.php'),
        );

        $files = [$path, $viewPath];

        if (! $this->option('force') && $this->checkForCollision($files)) {
            return static::INVALID;
        }

        $this->copyStubToApp('ContentBlock', $path, [
            'class' => $contentBlockClass,
            'namespace' => 'App\\Http\\Livewire',
            'name' => $name,
        ]);

        $this->copyStubToApp('ContentBlockView', $viewPath);

        $this->info("Successfully created {$contentBlock}!");

        return static::SUCCESS;
    }
}
