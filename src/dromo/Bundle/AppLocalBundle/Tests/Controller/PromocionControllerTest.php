<?php

namespace dromo\Bundle\AppLocalBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PromocionControllerTest extends WebTestCase
{
    public function testTodas()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/promocion/todas/{pagina}');
    }

}
