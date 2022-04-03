<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testHello(): void
    {
        $_GET['name'] = 'n3wborn';

        ob_start();
        include 'src/public/index.php';
        $content = ob_get_clean();

        $this->assertEquals('Hello n3wborn', $content);
    }
}
