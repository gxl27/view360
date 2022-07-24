<?php

namespace App\Test\Controller;

use App\Entity\Variant;
use App\Repository\VariantRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VariantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private VariantRepository $repository;
    private string $path = '/admin/variant/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Variant::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Variant index');

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
            'variant[name]' => 'Testing',
            'variant[document]' => 'Testing',
            'variant[updatedAt]' => 'Testing',
            'variant[status]' => 'Testing',
            'variant[category]' => 'Testing',
        ]);

        self::assertResponseRedirects('/admin/variant/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Variant();
        $fixture->setName('My Title');
        $fixture->setDocument('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCategory('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Variant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Variant();
        $fixture->setName('My Title');
        $fixture->setDocument('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCategory('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'variant[name]' => 'Something New',
            'variant[document]' => 'Something New',
            'variant[updatedAt]' => 'Something New',
            'variant[status]' => 'Something New',
            'variant[category]' => 'Something New',
        ]);

        self::assertResponseRedirects('/admin/variant/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDocument());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getCategory());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Variant();
        $fixture->setName('My Title');
        $fixture->setDocument('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCategory('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/admin/variant/');
    }
}
