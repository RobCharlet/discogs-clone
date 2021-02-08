<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\RecordFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class RecordResourceTest extends ApiTestCase
{
    use Factories;
    use ResetDatabase;

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

    public function testUpdateRecord()
    {
        $client = self::createClient();

        $record = RecordFactory::new()->create();

        $client->request('PUT', '/api/records/'.$record->getId(), [
            'json' => [
                'title' => 'updated',
                "releaseDate"=> '2012-09-10',
            ]
        ]);

        $this->assertResponseStatusCodeSame(202);
    }

    public function testGetRecordItem()
    {
        $client = self::createClient();

        $record = RecordFactory::new()->create();

        $client->request('GET', '/api/records/'.$record->getId(), []);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetRecordsCollection()
    {
        $client = self::createClient();

        $record = RecordFactory::new()->create([
            'title' => 'Deacon blues',
            'releaseDate' => \DateTimeImmutable::createFromFormat('Y-m-d', '2015-06-07'),
        ]);
        $record2 = RecordFactory::createMany(49);

        $client->request('GET', '/api/records', []);

        $this->assertResponseIsSuccessful();

        // Asserts that the returned content type is JSON-LD (the default)
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        $this->assertJsonContains([
            '@context' => '/api/contexts/Record',
            '@id' => '/api/records',
            '@type' => 'hydra:Collection',
            "hydra:totalItems" => 50,
            'hydra:view' => [
                '@id' => '/api/records?page=1',
                '@type' => 'hydra:PartialCollectionView',
                'hydra:first' => '/api/records?page=1',
                'hydra:last' => '/api/records?page=2',
                'hydra:next' => '/api/records?page=2',
            ],
        ]);
    }
}