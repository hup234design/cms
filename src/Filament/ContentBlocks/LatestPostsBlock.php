<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Models\Post;

class LatestPostsBlock extends ContentBlock implements ContentBlockTemplate
{
    public bool $core = true;

    public static function getBlockName(): string
    {
        return "latest-posts-block";
    }

    public static function getBlockLabel(): string
    {
        return "Latest Posts";
    }

    public function setData($data): array
    {
        $data['latest_posts'] = Post::with('featured_image')->published()->get()->take( $data['posts_count'] ?? 3 );
        return parent::setData($data);
    }

    public static function getBlockFields(): array
    {
        return [
            Forms\Components\TextInput::make('heading'),
                Forms\Components\TextInput::make('subheading'),
                Forms\Components\Select::make('posts_count')
                    ->options([
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ])
                    ->default(3)
                    ->required()
            ];
    }
}
