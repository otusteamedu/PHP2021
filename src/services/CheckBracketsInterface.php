<?php

namespace Services;

interface CheckBracketsInterface
{
    public function setString(string $string): void;
    public function getString(): string;
    public function check(): bool;
}