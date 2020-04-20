<?php

namespace PortalBundle\ViewHelpers;

use ContentBundle\Entity\Plot;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Response as HttpResponse;


class Component
{

	private $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine    = $doctrine;
	}

	/**
	 *
	 * * @param $cadastralNumber array
	 */
	public function findCadastralNumber($cadastralNumber)
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

		$body = null;
		if ($response->getStatusCode() == 200) {

			$body =  json_decode($response->getBody()->getContents(), true);

		};

		$plotRepo = $this->doctrine->getRepository('ContentBundle:Plot');

		$ret = [];

		//debug
		if (!count($body)) {
			foreach (($cadastralNumber) as $key => $value) {
				$plot  = $plotRepo->findOneByCadastralNumber($value);
				$ret[] = $plot;
			}
		} else {
			foreach (($body) as $key => $value) {

				$plot = $plotRepo->findOneByCadastralNumber($value['cadastral_number']);

				if (!$plot) {
					$plot = new Plot();
					$plot->setCadastralNumber($value['cadastral_number']);
					$plot->setAddress($value['address']);
					$plot->setPrice('price');
					$plot->setArea('area');

					$this->doctrine->getManager()->persist($plot);
					$this->doctrine->getManager()->flush($plot);

				}
				$ret[] = $plot;
			}
		}

		return $ret;
	}

}
