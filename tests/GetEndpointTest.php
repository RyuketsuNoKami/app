<?php

namespace App\Tests;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class GetEndpointTest extends WebTestCase
{
    /**@test */
    public function testGetEndpoint(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/hello/showall');

        $response = $client->getResponse();
        $this->assertSame(500, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

    }

    public function testGetEndpoint2(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/hello/show/1');

        $response = $client->getResponse();
        $this->assertSame(500, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

    }


    public function testPostEndpoint(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/hello/register');

        $response = $client->getResponse();
        $this->assertSame(500, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

    }

    public function testDeleteEndpoint(): void
    {
        $client = static::createClient();
        $crawler = $client->request('DELETE', '/hello/delete/8');

        $response = $client->getResponse();
        $this->assertSame(500, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

    }
}
