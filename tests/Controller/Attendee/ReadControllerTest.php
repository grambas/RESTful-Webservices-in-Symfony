<?php

declare(strict_types=1);

namespace App\Tests\Controller\Attendee;

use App\Tests\ApiTestCase;

class ReadControllerTest extends ApiTestCase
{
    public function test_it_should_requested_attendee(): void
    {
        $this->loadFixtures([
            __DIR__.'/fixtures/read_attendee.yaml',
        ]);

        $this->browser->request('GET', '/attendees/b8bfdd2d-072f-4462-8dac-22d6fb92c335');

        static::assertResponseIsSuccessful();

        $this->assertMatchesJsonSnapshot($this->browser->getResponse()->getContent());
    }
}
