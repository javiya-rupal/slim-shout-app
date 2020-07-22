<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Api\Controller;

use Slim\Psr7\Factory\ServerRequestFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

class HomeControllerFailureTest extends TestCase
{
    private const NUMBEROFQUOTES = '11';

    private const PERSONNAME = 'albert-einstein';

    private const RESPONSE = ['error' => 'You can request minimum 1 and maximum 10 quotes only!'];

    private ResponseInterface $response;

    protected function setUp(): void
    {
        parent::setUp();

        $requestObject = new ServerRequestFactory();
        
        $request = $requestObject->createServerRequest(
            'GET',
            sprintf('/shout/%s/%s', self::PERSONNAME, self::NUMBEROFQUOTES),
        );

        $app = require __DIR__ . '/../../../../../config/bootstrap.php';

        $this->response = $app->handle($request);
    }

    public function testStatusCode(): void
    {
        $this->assertSame(200, $this->response->getStatusCode());
    }

    public function testContentType(): void
    {
        $this->assertSame('application/json', $this->response->getHeaderLine('Content-Type'));
    }

    public function testBody(): void
    {
        $json = json_decode((string) $this->response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertEquals(self::RESPONSE, $json);
    }
}