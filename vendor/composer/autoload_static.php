<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6933aacefaf7659717354ad2bc91172a
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6933aacefaf7659717354ad2bc91172a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6933aacefaf7659717354ad2bc91172a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6933aacefaf7659717354ad2bc91172a::$classMap;

        }, null, ClassLoader::class);
    }
}