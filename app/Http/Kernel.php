<?php

namespace App\Http;

use App\Http\Middleware\ApplicationMiddleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckForMaintenanceMode;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\EnsurePhoneIsVerified;
use App\Http\Middleware\FillProfile;
use App\Http\Middleware\ForceJson;
use App\Http\Middleware\HtmlMinifier;
use App\Http\Middleware\Login2faMiddleware;
use App\Http\Middleware\OptimizeMiddleware;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SetDefaultLocaleForUrls;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\ValidateSignature;
use App\Http\Middleware\VerifyCsrfToken;
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
// use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
// use Litespeed\LSCache\LSCacheMiddleware;
// use Litespeed\LSCache\LSTagsMiddleware;
use Modules\Security\Http\Middleware\SecureHeaders;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use Spatie\Varnish\Middleware\CacheWithVarnish;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \Fruitcake\Cors\HandleCors::class,
        // \App\Http\Middleware\CorsMiddleware::class,
        \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        // HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        // SecureHeaders::class,
        StartSession::class,

        // \App\Http\Middleware\BlockIpAddressMiddleware::class,

        // \App\Http\Middleware\LanguageMiddleware::class,

        // \App\Http\Middleware\CorsMiddleware::class,

        // \Litespeed\LSCache\LSCacheMiddleware::class,
        // \Litespeed\LSCache\LSTagsMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
            CheckForMaintenanceMode::class,
            VerifyCsrfToken::class,

            // \App\Http\Middleware\BlockIpAddressMiddleware::class,

            // \App\Http\Middleware\LanguageMiddleware::class,

            // FilterIfPjax::class,
            //
            // \RenatoMarinho\LaravelPageSpeed\Middleware\InlineCss::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\TrimUrls::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveQuotes::class,
            // \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class,

            // HtmlMinifier::class,
            //        SecureHeadersMiddleware::class,

            // LSCacheMiddleware::class,
            // LSTagsMiddleware::class,

            // PrevLink::class,

            //        IPFirewall::class,
            //        RedirectInvalidIPs::class,
            // WebRequestMonitoring
            // ::class,

            // OptimizeMiddleware::class
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            // VerifyCsrfToken::class,

            // EnsureFrontendRequestsAreStateful::class,

            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
            CheckForMaintenanceMode::class,
            VerifyCsrfToken::class,
            // StartSession::class,
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // WebRequestMonitoring::class,

            // \App\Http\Middleware\LanguageMiddleware::class,

        ],
    ];

    /**
     * The application's route middleware.
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'               => Authenticate::class,
        'auth.basic'         => AuthenticateWithBasicAuth::class,
        'cache.headers'      => SetCacheHeaders::class,
        'can'                => Authorize::class,
        'guest'              => RedirectIfAuthenticated::class,
        'password.confirm'   => RequirePassword::class,
        // 'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'signed' => \App\Http\Middleware\ValidateHttpsSignature::class,
        // 'signed'             => ValidateSignature::class,
        'throttle'           => ThrottleRequests::class,
        'verified'           => EnsureEmailIsVerified::class,
        'mobile_verified'    => EnsurePhoneIsVerified::class,
        'role'               => RoleMiddleware::class,
        'permission'         => PermissionMiddleware::class,
        'role_or_permission' => RoleOrPermissionMiddleware::class,

        // 'application'  => ApplicationMiddleware::class,
        // 'fill_profile' => FillProfile::class,

        // '2fa'       => Login2faMiddleware::class,

        // 'force_json'       => ForceJson::class,

        // 'multi_locale'       => SetDefaultLocaleForUrls::class,

        'verify_csrf'       => VerifyCsrfToken::class,

        // 'setLocale' => \App\Http\Middleware\SetLocaleMiddleware::class,

        // 'doNotCacheResponse' => DoNotCacheResponse::class,
        // 'optimizeImages'     => OptimizeImages::class,
        // 'cacheResponse'      => CacheResponse::class,

        // 'lscache' => \Litespeed\LSCache\LSCacheMiddleware::class,
        // 'lstags' => \Litespeed\LSCache\LSTagsMiddleware::class,

        // 'cacheable'=>\App\Http\Middleware\CacheResponse::class,
        //
        // 'cacheable' => CacheWithVarnish::class,
        'fill_profile' => FillProfile::class,

    ];
}
