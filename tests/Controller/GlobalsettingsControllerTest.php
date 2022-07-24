<?php

namespace App\Test\Controller;

use App\Entity\Globalsettings;
use App\Repository\GlobalsettingsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GlobalsettingsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private GlobalsettingsRepository $repository;
    private string $path = '/admin/globalsettings/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Globalsettings::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Globalsetting index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'globalsetting[closeWebsite]' => 'Testing',
            'globalsetting[frames]' => 'Testing',
            'globalsetting[zoom]' => 'Testing',
            'globalsetting[maxItems]' => 'Testing',
            'globalsetting[closeRegister]' => 'Testing',
        ]);

        self::assertResponseRedirects('/admin/globalsettings/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Globalsettings();
        $fixture->setCloseWebsite('My Title');
        $fixture->setFrames('My Title');
        $fixture->setZoom('My Title');
        $fixture->setMaxItems('My Title');
        $fixture->setCloseRegister('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Globalsetting');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Globalsettings();
        $fixture->setCloseWebsite('My Title');
        $fixture->setFrames('My Title');
        $fixture->setZoom('My Title');
        $fixture->setMaxItems('My Title');
        $fixture->setCloseRegister('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'globalsetting[closeWebsite]' => 'Something New',
            'globalsetting[frames]' => 'Something New',
            'globalsetting[zoom]' => 'Something New',
            'globalsetting[maxItems]' => 'Something New',
            'globalsetting[closeRegister]' => 'Something New',
        ]);

        self::assertResponseRedirects('/admin/globalsettings/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCloseWebsite());
        self::assertSame('Something New', $fixture[0]->getFrames());
        self::assertSame('Something New', $fixture[0]->getZoom());
        self::assertSame('Something New', $fixture[0]->getMaxItems());
        self::assertSame('Something New', $fixture[0]->getCloseRegister());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Globalsettings();
        $fixture->setCloseWebsite('My Title');
        $fixture->setFrames('My Title');
        $fixture->setZoom('My Title');
        $fixture->setMaxItems('My Title');
        $fixture->setCloseRegister('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/admin/globalsettings/');
    }
}
