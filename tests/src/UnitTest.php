<?php
/**
 * Created by PhpStorm.
 * User: svetlanakartysh
 * Date: 20.04.2020
 * Time: 10:56
 */

namespace Tests\src;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UnitTest extends TestCase
{
	/**
	 ** @doesNotPerformAssertions
	 * * @param $cadastralNumber array
	 */
	public function testFindCadastralNumberWithoutUsingAssertions($cadastralNumber = [])
	{
		$body = json_encode ([
			"collection" => [
				"plots" => $cadastralNumber,
			],
		]);

		$client = new Client([
			'base_uri'                          => 'http://pkk.bigland.ru/',
			\GuzzleHttp\RequestOptions::HEADERS => [
				'User-Agent' => 'some-special-agent',
				'Accept' => 'application/json',
				'Content-Type' => 'application/json'
			],
			'defaults'                          => [
				\GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => 5,
				\GuzzleHttp\RequestOptions::ALLOW_REDIRECTS => true,
			],
			\GuzzleHttp\RequestOptions::VERIFY  => false,
		]);

		$response = $client->request('GET', 'api/test/plots',
			[],
			$body
		);

		$data = null;

		if ($response->getStatusCode() == 200) {
			$data = $response->getBody();
		};

		return $data;
	}
}