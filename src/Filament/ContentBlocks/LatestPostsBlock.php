<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Models\Post;

class LatestPostsBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array
    {
        $data['latest_posts'] = Post::with('featured_image')->published()->get()->take( $data['posts_count'] ?? 3 );
        return parent::setData($data);
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('latest-posts-block')
            ->label('Latest Posts')
            ->schema([
                Forms\Components\TextInput::make('heading'),
                Forms\Components\TextInput::make('subheading'),
                Forms\Components\Select::make('posts_count')
                    ->options([
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ])
                    ->default(2)
                    ->required()
            ]);
    }
}
