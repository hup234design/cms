<?php

namespace Hup234design\Cms\Contracts;

interface ContentBlockTemplate
{
    public static function getBlockName(): string;

    public static function getBlockLabel(): string;

    public static function getBlockFields(): array;
}
