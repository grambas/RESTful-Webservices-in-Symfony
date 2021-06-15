<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Attendee;
use App\Entity\Workshop;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class AttendeeNormalizer implements ContextAwareNormalizerInterface
{
    public function __construct(
        private ObjectNormalizer $normalizer
    ) {
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data  instanceof Attendee;
    }

    /**
     * This works like DTO
     * Works good when representation is very similar to entity.
     *
     * @param Attendee $object
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        $customContext = [
          AbstractNormalizer::IGNORED_ATTRIBUTES => ['id'],
          AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => fn (Attendee $object, $format, $context) => $object->getIdentifier(),
        ];

        $context = array_merge($context, $customContext);

        $data = $this->normalizer->normalize($object, $format, $context);

        return $data;
    }
}
