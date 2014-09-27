<?php

namespace pno;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class IpBan implements HttpKernelInterface {

	/**
	 * @var HttpKernelInterface
	 */
	private $app;
	/**
	 * @var array
	 */
	private $banned_ips;
	/**
	 * @var null
	 */
	private $restricted_response;

	public function __construct(HttpKernelInterface $app, array $banned_ips = [], Response $restricted_response = null)
	{
		$this->app = $app;
		$this->banned_ips = $banned_ips;
		$this->restricted_response = $restricted_response ?: new Response('Your IP has been banned', 403);
	}

	public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
	{
		if (in_array($request->getClientIp(), $this->banned_ips)) {
			return $this->restricted_response;
		}

		return $this->app->handle($request);
	}

} 