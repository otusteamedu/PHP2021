<?php

namespace App\Storage;

use App\Hero;
use App\Storage\HeroIdentityMap;
use App\Interfaces\StorageInterface;

class HeroMapper implements StorageInterface
{
    private $DBAdapter;

    private HeroIdentityMap $heroIdentityMap;

    public function __construct($DBAdapter)
    {
        $this->DBAdapter = $DBAdapter;
        $this->heroIdentityMap = new HeroIdentityMap();
    }

    public function selectById(int $id): Hero
    {
        if ($this->heroIdentityMap->hasId($id)) {
            return $this->heroIdentityMap->getHero($id);
        }

        $result = $this->DBAdapter->selectById($id);

        if (empty($result)) {
            throw new \Exception("No record with id: $id");
        }

        $this->heroIdentityMap->set($id, $result);

        return new Hero(
            $result['id'],
            $result['class'],
            $result['name'],
            $result['race']
        );
    }

    public function selectAll(): array
    {
        $records = $this->DBAdapter->selectAll();
        $arHeroes = [];
        foreach ($records as $record) {
            $arHeroes[] = new Hero(
                $record['id'],
                $record['class'],
                $record['name'],
                $record['race']
            );
        }

        return $arHeroes;
    }

    public function insert(array $rawHeroData): Hero
    {
        $resultId = $this->DBAdapter->insert([
            $rawHeroData['class'],
            $rawHeroData['name'],
            $rawHeroData['race'],
        ]);

        if (!$resultId) {
            throw new \Exception("Insert failed");
        }

        return new Hero(
            $resultId,
            $rawHeroData['class'],
            $rawHeroData['name'],
            $rawHeroData['race']
        );
    }

    public function update(array $rawHeroData): bool
    {
        return $this->DBAdapter->update([
            $rawHeroData['class'],
            $rawHeroData['name'],
            $rawHeroData['race'],
            $rawHeroData['id'],
        ]);
    }

    public function deleteById(int $id): bool
    {
        return $this->DBAdapter->deleteById($id);
    }
}
