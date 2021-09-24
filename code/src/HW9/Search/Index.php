<?php

namespace HW9\Search;

class Index extends Search
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function initFromMappingFile(string $mapping_json_file) : void
    {
        $mapping = $this->getArrayFromFile($mapping_json_file);

        $indexes = array(self::INDEX_CHANNELS, self::INDEX_VIDEOS);

        foreach ($mapping as $map) {
            if (!in_array($map['index'], $indexes)) {
                continue;
            }
            $this->create($map['index'], $map);
        }
    }

    private function getArrayFromFile($file_name) : array
    {
        $mapping = json_decode(file_get_contents($file_name), 1);
        return $mapping;
    }

    private function create(string $index_name, array $map) : void
    {
        try {
            $this->client->indices()->delete([
                'index' => $index_name,
            ]);
        } catch (\Exception $e) {
        }

        $this->client->indices()->create([
            'index' => $index_name,
        ]);

        $this->client->indices()->putMapping($map);
    }
}
