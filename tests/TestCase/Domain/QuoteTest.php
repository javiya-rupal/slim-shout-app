<?php
declare(strict_types=1);

namespace App\Tests\Domain;

use App\DataProviders\QuotesFromJsonReader;
use PHPUnit\Framework\TestCase;
use App\Domain;

class QuoteTest extends TestCase
{
    private $fileGetContentsWrapper;

    //---------------------------------------------------------------------//
    // Setup                                                               //
    //---------------------------------------------------------------------//

    protected function setUp(): void
    {
        $this->fileGetContentsWrapper = $this->createMock( \App\DataProviders\QuotesFromJsonReader::class );

        parent::setUp();
    }

    //---------------------------------------------------------------------//
    // Tests                                                               //
    //---------------------------------------------------------------------//
    public function testGetQuotesByPersonName(): void
    {
        $simulatedQuotesArray = array (
            array (
              'quote' => 'Life isn’t about getting and having, it’s about giving and being.',
              'author' => 'Kevin Kruse',
            ),
            array (
              'quote' => 'Whatever the mind of man can conceive and believe, it can achieve.',
              'author' => 'Napoleon Hill',
            ),
            array (
              'quote' => 'Strive not to be a success, but rather to be of value.',
              'author' => 'Albert Einstein',
            ),
            array (
              'quote' => 'Two roads diverged in a wood, and I—I took the one less traveled by, And that has made all the difference.',
              'author' => 'Kevin Kruse',
            ),
            array (
              'quote' => 'A person who never made a mistake never tried anything new.',
              'author' => 'Albert Einstein',
            ),
            array (
              'quote' => 'I attribute my success to this: I never gave or took any excuse.',
              'author' => 'Albert Einstein',
            )
          );

        $this->fileGetContentsWrapper->method( 'getData' )->willReturn( $simulatedQuotesArray );

        $sut = $this->getSut();

        $sut->filterQuotesByPersonName('albert-einstein', 2);
        $result = $sut->quotes();
        $this->assertEquals(count($result), 2);

        $sut->filterQuotesByPersonName('obama', 3);
        $result = $sut->quotes();
        $this->assertEquals(count($result), 0);
    }

    //---------------------------------------------------------------------//
    // Private                                                             //
    //---------------------------------------------------------------------//
    private function getSut() : \App\Domain\Quote
    {
        return new \App\Domain\Quote( $this->fileGetContentsWrapper );
    }
}