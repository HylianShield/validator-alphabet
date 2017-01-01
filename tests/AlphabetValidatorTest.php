<?php
/**
 * Copyright MediaCT. All rights reserved.
 * https://www.mediact.nl
 */

namespace HylianShield\Tests\Validator\Alphabet;

use HylianShield\Alphabet\AlphabetInterface;
use HylianShield\Validator\Alphabet\AlphabetValidator;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \HylianShield\Validator\Alphabet\AlphabetValidator
 */
class AlphabetValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Create a mock alphabet for the given characters.
     *
     * @param string[] ...$characters
     *
     * @return AlphabetInterface
     */
    private function createAlphabetMock(
        string ...$characters
    ): AlphabetInterface {
        $alphabet       = $this->createMock(AlphabetInterface::class);
        $validReturns   = array_fill(0, count($characters), true);
        $validReturns[] = false;

        $alphabet
            ->expects($this->any())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(...$validReturns);

        $alphabet
            ->expects($this->any())
            ->method('current')
            ->willReturnOnConsecutiveCalls(...$characters);

        $alphabet
            ->expects($this->any())
            ->method('key')
            ->willReturnOnConsecutiveCalls(...array_keys($characters));

        return $alphabet;
    }

    /**
     * @return array[]
     */
    public function validationProvider(): array
    {
        return [
            // All characters present.
            [true, 'ABC', 'A', 'B', 'C'],
            // Illegal character present.
            [false, 'ABC', 'A', 'B'],
            // Cannot match multi-line strings.
            [false, 'ABC' . PHP_EOL . 'ABC', 'A', 'B', 'C']
        ];
    }

    /**
     * @dataProvider validationProvider
     *
     * @param bool      $expected
     * @param string    $message
     * @param string[]  ...$alphabet
     *
     * @return void
     * @covers ::__construct
     */
    public function testValidation(
        bool $expected,
        string $message,
        string ...$alphabet
    ) {
        $validator = new AlphabetValidator(
            $this->createAlphabetMock(...$alphabet)
        );

        $this->assertEquals(
            $expected,
            $validator->validate($message)
        );
    }
}
