<?php

namespace App\Validator\Foursquare;

use App\Validator\AbstractValidator;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CategoryValidator
 */
class CategoryValidator extends AbstractValidator
{

    /**
     * @param array $input
     *
     * @throws InvalidArgumentException;
     */
    public function validate(array $input): void
    {
        $constraints = new Assert\Collection([
            'id' => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\Type('string'),
            ]),
            'name' => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\Type('string'),
            ]),
            'iconPrefix' => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\Type('string'),
            ]),
            'iconSuffix' => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\Type('string'),
                new Assert\LessThan(11),
            ]),
        ]);

        $this->validateConstraints($input, [$constraints]);
    }
}