<?php

namespace App\Library\UI\RestNormalizer;

use App\Library\Domain\Record;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecordNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'title' => $object->getTitle(),
            'ReleaseDate' => $object->getReleaseDate()->format('Y-m-d')
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Record;
    }
}