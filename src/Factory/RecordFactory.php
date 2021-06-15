<?php

namespace App\Factory;

use App\Library\Domain\Record;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Record|Proxy createOne(array $attributes = [])
 * @method static Record[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Record|Proxy findOrCreate(array $attributes)
 * @method static Record|Proxy random(array $attributes = [])
 * @method static Record|Proxy randomOrCreate(array $attributes = [])
 * @method static Record[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Record[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Record|Proxy create($attributes = [])
 */
final class RecordFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'id' => Uuid::v4(),
            'title' => self::faker()->realText(50),
            'releaseDate' => DateTimeImmutable::createFromMutable(self::faker()->dateTimeThisCentury()),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Record $record) {})
        ;
    }

    protected static function getClass(): string
    {
        return Record::class;
    }
}
