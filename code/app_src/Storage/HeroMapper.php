<?php

namespace App\Storage;

use App\Hero;
use App\Interfaces\StorageInterface;

class HeroMapper
{
    private $DBAdapter;

    private HeroIdentityMap $heroIdentityMap;

    public function __construct($DBAdapter)
    {
        $this->DBAdapter = $DBAdapter;
        $this->heroIdentityMap = new HeroIdentityMap();
    }

    public function selectByNickname(string $nickname): Hero
    {
        $result = $this->DBAdapter->selectByNickname($nickname);

        if (empty($result)) {
            throw new \Exception("Не найдено супер-героя с псевдонимом: $nickname");
        }

        $this->heroIdentityMap->set($result);

        return new Hero($result['id'], $result['nickname'], $result['real_name'], $result['super_force']);
    }

    public function selectAll(): array
    {
        $heroes = $this->DBAdapter->selectAll();
        $arHeroes = [];

        foreach ($heroes as $hero) {
            $arHeroes[] = new Hero($hero['id'], $hero['nickname'], $hero['real_name'], $hero['super_force']);
        }

        return $arHeroes;
    }

    public function insert(array $heroData): Hero
    {
        $resultId = $this->DBAdapter->insert([$heroData['nickname'], $heroData['real_name'], $heroData['super_force']]);

        if (!$resultId) {
            throw new \Exception("Не удалось добавить данные");
        }

        return new Hero($resultId, $heroData['nickname'], $heroData['real_name'], $heroData['super_force']);
    }

    public function update(array $heroData): array
    {
        $result['status'] = $this->DBAdapter->update([
            $heroData['nickname'],
            $heroData['real_name'],
            $heroData['super_force'],
            $heroData['id'],
        ]);

        if ($result['status']) {
            $result['action'] = 'updated';
        } else {
            $result['action'] = 'update_error';
        }

        return $result;
    }

    public function deleteById(int $id): bool
    {
        return $this->DBAdapter->deleteById($id);
    }
}
