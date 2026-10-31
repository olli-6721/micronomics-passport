<?php

namespace Micronomics\Passport\Framework\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerFactory
{
    public static function create(): SerializerInterface
    {
        return new Serializer(
            normalizers: [
                new BackedEnumNormalizer(),
                new DateTimeNormalizer(),
                new UidNormalizer(),
                new ObjectNormalizer()
            ],
            encoders: [
                new JsonEncoder()
            ]
        );
    }
}
