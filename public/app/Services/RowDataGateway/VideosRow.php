<?php

namespace App\Services\RowDataGateway;

use PDO;
use PDOStatement;

class VideosRow
{
    /**
     * @var int|null
     */
    private ?int $id;

    /**
     * @var int|null
     */
    private ?int $channelsId;

    /**
     * @var string|null
     */
    private ?string $name;

    /**
     * @var int|null
     */
    private ?int $likes;

    /**
     * @var int|null
     */
    private ?int $dislikes;

    /**
     * @var PDO
     */
    private PDO $PDO;

    /**
     * @var PDOStatement
     */
    private PDOStatement $insertStatement;

    /**
     * @var PDOStatement
     */
    private PDOStatement $updateStatement;

    /**
     * @var PDOStatement
     */
    private PDOStatement $deleteStatement;

    /**
     * @param PDO $PDO
     */
    public function __construct(PDO $PDO)
    {
        $this->PDO = $PDO;
        $this->insertStatement = $PDO->prepare(
            'INSERT INTO videos (channels_id, name, likes, dislikes) VALUES (?, ?, ?, ?)'
        );
        $this->updateStatement = $PDO->prepare(
            'UPDATE videos SET channels_id = ?, name = ?, likes = ?, dislikes = ? WHERE id = ?'
        );
        $this->deleteStatement = $PDO->prepare(
            'DELETE FROM videos WHERE id = ?'
        );
    }

    /**
     * @return int
     */
    public function insert(): int
    {
        $this->insertStatement->execute([
            $this->channelsId,
            $this->name,
            $this->likes,
            $this->dislikes
        ]);

        $this->id = (int) $this->PDO->lastInsertId();
        return $this->id;
    }

    /**
     * @return bool
     */
    public function update(): bool
    {
        return $this->updateStatement->execute([
           $this->channelsId,
           $this->name,
           $this->likes,
           $this->dislikes,
           $this->id
        ]);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        $this->id = null;
        return $this->deleteStatement->execute([
            $this->id
        ]);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getChannelsId(): ?int
    {
        return $this->channelsId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getLikes(): ?int
    {
        return $this->likes;
    }

    /**
     * @return int|null
     */
    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    /**
     * @param int $channelsId
     * @return void
     */
    public function setChannelsId(int $channelsId): void
    {
        $this->channelsId = $channelsId;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $likes
     * @return void
     */
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @param int $dislikes
     * @return void
     */
    public function setDislikes(int $dislikes): void
    {
        $this->dislikes = $dislikes;
    }
}
