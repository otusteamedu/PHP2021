<?php

namespace HW9\Search\Settings;

class EnvAppSettings extends AppSettings implements Settings
{
    public function setHost(): void
    {
        $this->host = getenv('ELASTICSEARCH_HOST', true) ?: getenv('ELASTICSEARCH_HOST');
    }
}
