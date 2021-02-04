<?php


namespace App\Tests\Functional;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class RecordResourceTest extends ApiTestCase
{
    public function testCreateRecord()
    {
        $client = self::createClient();

        $recordData = [
            'title' => 'MMMM FOOD',
            'releaseDate' => '2015-06-01'
        ];

        $client->request('POST', '/api/records', [
            'json' => $recordData,
        ]);

        $this->assertResponseStatusCodeSame(202);
    }
}