<?php

declare(strict_types=1);

namespace MySite\app\Support\Entities;


use DateTime;

/**
 * @Entity
 * @Table(name="endpoints", indexes={
 *     @Index(name="ip_idx", columns={"user_ip"}),
 *     @Index(name="checked_idx", columns={"is_checked"})
 * })
 */
class Endpoint
{
    /**
     * @Id
     * @Column(type="bigint")
     * @GeneratedValue
     *
     * @var int
     */
    private int $id;

    /**
     * @Column(type="string", nullable="true", name="http_referer")
     *
     * @var string|null
     */
    private ?string $httpReferer;

    /**
     * @Column(type="string", nullable="true", name="query_string")
     *
     * @var string|null
     */
    private ?string $queryString;

    /**
     * @Column(type="string", nullable="true", name="redirected_query_string")
     *
     * @var string|null
     */
    private ?string $redirectedQueryString;

    /**
     * @Column(type="string", nullable="true", name="user_ip")
     *
     * @var string|null
     */
    private ?string $userIp;

    /**
     * @Column(type="string", nullable=true, name="user_agent")
     *
     * @var string|null
     */
    private ?string $userAgent;

    /**
     * @Column(type="boolean", name="is_checked")
     *
     * @var bool
     */
    private bool $isChecked = false;

    /**
     * @Column(type="datetime", name="created_at")
     *
     * @var DateTime
     */
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @param array $validated
     * @return Endpoint
     */
    public static function createFromArray(array $validated): Endpoint
    {
        $endpoint = new self();

        $endpoint->setHttpReferer($validated['http_referer']);
        $endpoint->setQueryString($validated['query_string']);
        $endpoint->setRedirectedQueryString($validated['redirected_query_string']);
        $endpoint->setUserIp($validated['user_ip']);
        $endpoint->setUserAgent($validated['user_agent']);

        return $endpoint;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Endpoint
     */
    public function setId(int $id): Endpoint
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHttpReferer(): ?string
    {
        return $this->httpReferer;
    }

    /**
     * @param string|null $httpReferer
     * @return Endpoint
     */
    public function setHttpReferer(?string $httpReferer): Endpoint
    {
        $this->httpReferer = $httpReferer;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQueryString(): ?string
    {
        return $this->queryString;
    }

    /**
     * @param string|null $queryString
     * @return Endpoint
     */
    public function setQueryString(?string $queryString): Endpoint
    {
        $this->queryString = $queryString;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedirectedQueryString(): ?string
    {
        return $this->redirectedQueryString;
    }

    /**
     * @param string|null $redirectedQueryString
     * @return Endpoint
     */
    public function setRedirectedQueryString(?string $redirectedQueryString): Endpoint
    {
        $this->redirectedQueryString = $redirectedQueryString;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserIp(): ?string
    {
        return $this->userIp;
    }

    /**
     * @param string|null $userIp
     * @return Endpoint
     */
    public function setUserIp(?string $userIp): Endpoint
    {
        $this->userIp = $userIp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param string|null $userAgent
     * @return Endpoint
     */
    public function setUserAgent(?string $userAgent): Endpoint
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return bool
     */
    public function isChecked(): bool
    {
        return $this->isChecked;
    }

    /**
     * @param bool $isChecked
     * @return Endpoint
     */
    public function setIsChecked(bool $isChecked): Endpoint
    {
        $this->isChecked = $isChecked;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Endpoint
     */
    public function setCreatedAt(DateTime $createdAt): Endpoint
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
