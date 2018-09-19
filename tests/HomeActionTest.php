<?php
/**
 * Created by Sabri Hamda.
 * Date: 19.09.18
 * Time: 11:22
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeActionTest
 * @package App\Tests
 */
class HomeActionTest extends WebTestCase
{
    /**
     * @var Client|null
     */
    private $client = null;

    /**
     *
     */
    protected function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     *
     */
    public function testIndex()
    {
        $this->client->request('GET', "/");

        static::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
