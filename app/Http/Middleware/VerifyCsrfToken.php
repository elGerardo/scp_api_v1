<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "api/login",
        "api/v1/scp",
        "api/v1/scp/{scp_id}",
        "api/v1/interviews",
        "api/v1/interviews/{id}",
        "api/v1/category",
        "api/v1/category/{name}",
        "api/v1/enemies/{scp_id}/enemy/{scp_enemy_id}",
    ];
}
