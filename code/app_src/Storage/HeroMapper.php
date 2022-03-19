<?php

namespace App\Storage;

use App\Hero;
use App\Storage\HeroIdentityMap;
use App\Interfaces\StorageInterface;
use PDO;
use PDOStatement;

class HeroMapper implements StorageInterface
{
    private PDO          $pdo;

    private PDOStatement $selectStatement;

    private PDOStatement $selectAllStatement;

    private PDOStatement $insertStatement;

    private PDOStatement $updateStatement;

    private PDOStatement $deleteStatement;

    private HeroIdentityMap $heroIdentityMap;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->heroIdentityMap = new HeroIdentityMap();

        $this->selectStatement = $pdo->prepare(
            'SELECT * FROM heroes WHERE id = ?'
        );
        $this->selectAllStatement = $pdo->prepare(
            'SELECT * FROM heroes'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO heroes (class, name, race) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE heroes SET class = ?, name = ?, race = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM heroes WHERE id = ?'
        );
    }

    public function selectById(int $id): Hero
    {
        if ($this->heroIdentityMap->hasId($id)) {
            return $this->heroIdentityMap->getHero($id);
        }

        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

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
        $this->selectAllStatement->execute();
        $arHeroes = [];
        while ($record = $this->selectAllStatement->fetch()) {
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
        $this->insertStatement->execute([
            $rawHeroData['class'],
            $rawHeroData['name'],
            $rawHeroData['race'],
        ]);

        return new Hero(
            (int)$this->pdo->lastInsertId(),
            $rawHeroData['class'],
            $rawHeroData['name'],
            $rawHeroData['race']
        );
    }

    public function update(array $rawHeroData): bool
    {
        return $this->updateStatement->execute([
            $rawHeroData['class'],
            $rawHeroData['name'],
            $rawHeroData['race'],
            $rawHeroData['id'],
        ]);
    }

    public function deleteById(int $id): bool
    {
        return $this->deleteStatement->execute([$id]);
    }
}
