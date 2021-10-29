<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class ImageValidatorChain implements ImageValidatorInterface
{
    /** @var ImageValidatorInterface[] */
    private array $validators;

    public function __construct(ImageValidatorInterface ...$validators)
    {
        $this->validators = $validators;
    }

    public function validate(Image $image): ?ImageException
    {
        return array_reduce(
            $this->validators,
            fn (?ImageException $carry, ImageValidatorInterface $validator) => (
                $carry ?? $validator->validate($image)
            )
        );
    }
}
