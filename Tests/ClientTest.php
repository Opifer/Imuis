<?php

namespace Opifer\Imuis\Tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use Mockery as m;
use Opifer\Imuis\Client as ImuisClient;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    private $partnerKey;
    private $environment;
    private $guzzleClient;

    public function setUp()
    {
        $this->partnerKey = 'sdfHSUidgknjnsd6Tsdf';
        $this->environment = '34589465745689';
        $this->url = 'http://httpbin.org';
        $this->guzzleClient = m::mock('GuzzleHttp\Client');
    }

    public function testLogin()
    {
        $stream = Stream::factory('<dataset><SESSION><SESSIONID>34545664</SESSIONID></SESSION></dataset>');

        $mock = new Mock([new Response(200, [], $stream)]);

        $client = new ImuisClient($this->partnerKey, $this->environment, $this->url);

        $guzzle = $client->getClient();
        $guzzle->getEmitter()->attach($mock);

        $actual = $client->login();

        $this->assertEquals('34545664', $actual);
    }

    public function testGetSessionID()
    {
        $client = m::mock('Opifer\Imuis\Client[login]', [$this->partnerKey, $this->environment, $this->url]);
        $client->shouldReceive('login');

        $client->getSessionId();
    }

    public function testGetClient()
    {
        $client = new ImuisClient($this->partnerKey, $this->environment, $this->url);
        $actual = $client->getClient();

        $this->assertInstanceOf('GuzzleHttp\Client', $actual);
    }
}
