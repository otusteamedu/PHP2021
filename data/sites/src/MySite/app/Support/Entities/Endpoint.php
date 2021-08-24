<?php
declare(strict_types=1);

namespace MySite\app\Support\Entities;


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
     * @var string
     */
    private string $httpReferer;

    /**
     * @Column(type="string", nullable="true", name="query_string")
     *
     * @var string
     */
    private string $queryString;

    /**
     * @Column(type="string", nullable="true", name="redirected_query_string")
     *
     * @var string
     */
    private string $redirectedQueryString;

    /**
     * @Column(type="string", nullable="true", name="user_ip")
     *
     * @var string
     */
    private string $userIp;

    /**
     * @Column(type="string", nullable=true, name="user_agent")
     *
     * @var string
     */
    private string $userAgent;

    /**
     * @Column(type="boolean", name="is_checked")
     *
     * @var bool
     */
    private bool $isChecked = false;

    /**
     * @Column(type="datetime", name="created_at", options={"default"= "CURRENT_TIMESTAMP"})
     *
     * @var string
     */
    private string $createdAt;


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
     * @return string
     */
    public function getHttpReferer(): string
    {
        return $this->httpReferer;
    }

    /**
     * @param string $httpReferer
     * @return Endpoint
     */
    public function setHttpReferer(string $httpReferer): Endpoint
    {
        $this->httpReferer = $httpReferer;
        return $this;
    }

    /**
     * @return string
     */
    public function getQueryString(): string
    {
        return $this->queryString;
    }

    /**
     * @param string $queryString
     * @return Endpoint
     */
    public function setQueryString(string $queryString): Endpoint
    {
        $this->queryString = $queryString;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectedQueryString(): string
    {
        return $this->redirectedQueryString;
    }

    /**
     * @param string $redirectedQueryString
     * @return Endpoint
     */
    public function setRedirectedQueryString(string $redirectedQueryString): Endpoint
    {
        $this->redirectedQueryString = $redirectedQueryString;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserIp(): string
    {
        return $this->userIp;
    }

    /**
     * @param string $userIp
     * @return Endpoint
     */
    public function setUserIp(string $userIp): Endpoint
    {
        $this->userIp = $userIp;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     * @return Endpoint
     */
    public function setUserAgent(string $userAgent): Endpoint
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
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Endpoint
     */
    public function setCreatedAt(string $createdAt): Endpoint
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
