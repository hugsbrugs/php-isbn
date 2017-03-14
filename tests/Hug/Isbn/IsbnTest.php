<?php

# For PHP7
// declare(strict_types=1);

// namespace Hug\Tests\Isbn;

use PHPUnit\Framework\TestCase;

use Hug\Isbn\Isbn as Isbn;

/**
 *
 */
final class HArrayTest extends TestCase
{
    public $valid_isbns = null;
    public $invalid_isbns = null;

    function __construct()
    {
        $this->valid_isbns = [
            '0061234001',
            '2070643026',
        ];

        $this->invalid_isbns = [
            '9782845674608',
        ];
    }

    /* ************************************************* */
    /* ************* Isbn ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanGetIsbnInfoWithValidIsbnCode()
    {
        # TEST GOOGLE PROVIDER
        foreach ($this->valid_isbns as $isbn)
        {
            $Isbn = new Isbn($isbn);
            $this->assertArrayHasKey('status', $Isbn->data);
            $this->assertEquals('success', $Isbn->data['status']);
        }
    }

    /**
     *
     */
    public function testCannotGetIsbnInfoWithInvalidIsbnCode()
    {
        # TEST GOOGLE PROVIDER
        foreach ($this->invalid_isbns as $isbn)
        {
            $Isbn = new Isbn($isbn);
            $this->assertArrayHasKey('status', $Isbn->data);
            $this->assertEquals('error', $Isbn->data['status']);
        }
    }

}

