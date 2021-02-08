<?php

namespace App\Library\UI\RestNormalizer;

use App\Library\Domain\Record;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecordNormalizer implements NormalizerInterface
{
    /**
     * @param Record $object
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'title' => $object->getTitle(),
            'releaseDate' => $object->getReleaseDate()->format('Y-m-d'),
            'createdAt' => $object->getCreatedAt()->format('Y-m-d')
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Record;
    }
}