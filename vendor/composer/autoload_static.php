<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit159f905812b48669bf18a50a16a2a499
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit159f905812b48669bf18a50a16a2a499::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit159f905812b48669bf18a50a16a2a499::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit159f905812b48669bf18a50a16a2a499::$classMap;

        }, null, ClassLoader::class);
    }
}
