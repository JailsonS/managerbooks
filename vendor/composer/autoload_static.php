<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba72afd77eeec1e2e72d9b73139670f2
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\' => 4,
        ),
        'c' => 
        array (
            'core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitba72afd77eeec1e2e72d9b73139670f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba72afd77eeec1e2e72d9b73139670f2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitba72afd77eeec1e2e72d9b73139670f2::$classMap;

        }, null, ClassLoader::class);
    }
}
