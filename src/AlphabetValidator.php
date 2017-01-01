<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\Validator\Alphabet;

use HylianShield\Alphabet\AlphabetInterface;
use HylianShield\Validator\Pcre\ExpressionValidator;

class AlphabetValidator extends ExpressionValidator
{
    /**
     * Constructor.
     *
     * @param AlphabetInterface $alphabet
     */
    public function __construct(AlphabetInterface $alphabet)
    {
        parent::__construct(
            sprintf(
                '/^[%s]*$/',
                implode(
                    '',
                    array_map(
                        'preg_quote',
                        iterator_to_array($alphabet)
                    )
                )
            )
        );
    }
}
