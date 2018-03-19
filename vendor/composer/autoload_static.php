<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit27e7fb646005e8d2c2cb12a31dcd2da1
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '65262669306b9cfaa9401133253e43a1' => __DIR__ . '/..' . '/torophp/torophp/src/Toro.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Controllers\\CommentController' => __DIR__ . '/../..' . '/app/controllers/comment_controller.php',
        'Controllers\\DownvoteController' => __DIR__ . '/../..' . '/app/controllers/downvote_controller.php',
        'Controllers\\HomeController' => __DIR__ . '/../..' . '/app/controllers/home_controller.php',
        'Controllers\\HomePageController' => __DIR__ . '/../..' . '/app/controllers/homepage_controller.php',
        'Controllers\\LinkController' => __DIR__ . '/../..' . '/app/controllers/link_controller.php',
        'Controllers\\LoginController' => __DIR__ . '/../..' . '/app/controllers/login_controller.php',
        'Controllers\\SignUpController' => __DIR__ . '/../..' . '/app/controllers/signup_controller.php',
        'Controllers\\TrendingController' => __DIR__ . '/../..' . '/app/controllers/trending_controller.php',
        'Controllers\\UpvoteController' => __DIR__ . '/../..' . '/app/controllers/upvote_controller.php',
        'Controllers\\UserController' => __DIR__ . '/../..' . '/app/controllers/user_controller.php',
        'DB' => __DIR__ . '/../..' . '/app/models/db.php',
        'Models\\CommentModel' => __DIR__ . '/../..' . '/app/models/comment_model.php',
        'Models\\DownvoteModel' => __DIR__ . '/../..' . '/app/models/downvote_model.php',
        'Models\\KarmaModel' => __DIR__ . '/../..' . '/app/models/karma_model.php',
        'Models\\LinkModel' => __DIR__ . '/../..' . '/app/models/link_model.php',
        'Models\\UpvoteModel' => __DIR__ . '/../..' . '/app/models/upvote_model.php',
        'Models\\UserModel' => __DIR__ . '/../..' . '/app/models/user_model.php',
        'View\\Loader' => __DIR__ . '/../..' . '/app/views/loader.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit27e7fb646005e8d2c2cb12a31dcd2da1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit27e7fb646005e8d2c2cb12a31dcd2da1::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit27e7fb646005e8d2c2cb12a31dcd2da1::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit27e7fb646005e8d2c2cb12a31dcd2da1::$classMap;

        }, null, ClassLoader::class);
    }
}
