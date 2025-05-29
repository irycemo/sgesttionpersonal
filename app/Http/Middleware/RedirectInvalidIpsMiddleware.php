<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;

class RedirectInvalidIpsMiddleware
{

    protected $ips = [
        '65.202.143.122',
        '148.185.163.203'
    ];

    protected $ipRanges = [
        '10.11.3.1',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        foreach ($request->getClientIps() as $ip) {

            if (! $this->isValidIp($ip) && ! $this->isValidIpRange($ip)) {

                return redirect('/');

            }

        }

        return $next($request);

    }

    protected function isValidIp($ip)
    {
        return in_array($ip, $this->ips);
    }

    protected function isValidIpRange($ip)
    {
        return IpUtils::checkIp($ip, $this->ipRanges);
    }

}
