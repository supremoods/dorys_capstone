<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf48bedafb587f3858bb32e0de11a8253
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf48bedafb587f3858bb32e0de11a8253::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf48bedafb587f3858bb32e0de11a8253::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf48bedafb587f3858bb32e0de11a8253::$classMap;

        }, null, ClassLoader::class);
    }
}