<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf81dc64b757525fe85e5f0f3f49a3398
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'pddUnionSdk\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'pddUnionSdk\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf81dc64b757525fe85e5f0f3f49a3398::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf81dc64b757525fe85e5f0f3f49a3398::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
