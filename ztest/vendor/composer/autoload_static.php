<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc74e439d93388ada8e34a7a4791000c2
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Calendar\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Calendar\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Calendar',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc74e439d93388ada8e34a7a4791000c2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc74e439d93388ada8e34a7a4791000c2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
