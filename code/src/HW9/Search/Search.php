<?php

namespace HW9\Search;

use Exception;

Class Search
{
    protected $elasticsearch = null;
    protected const INDEX_CHANNELS = 'channels';
    protected const INDEX_VIDEOS = 'videos';

    public function __construct( \Elasticsearch\Client $elasticsearch )
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function initIndexes( string $mapping_json_file ) : void
    {
        $mapping = $this->getIndexesArrayFromFile( $mapping_json_file );

        $indexes = array( self::INDEX_CHANNELS, self::INDEX_VIDEOS );

        foreach ( $mapping as $map )
        {
            if ( !in_array( $map['index'], $indexes ) )
            {
                continue;
            }
            $this->initIndex( $map['index'], $map );
        }
    }

    private function initIndex( string $index_name, array $map) : void
    {
        try
        {
            $this->elasticsearch->indices()->delete([
                'index' => $index_name,
            ]);
        }
        catch (\Exception $e)
        {
        }

        $this->elasticsearch->indices()->create( [
            'index' => $index_name,
        ] );

        $this->elasticsearch->indices()->putMapping( $map );
    }

    private function getIndexesArrayFromFile( $file_name ) : array
    {
        $mapping = json_decode( file_get_contents( $file_name ), 1 );
        return $mapping;
    }

    public function addChannel( string $id, string $title ) : void
    {
        $this->elasticsearch->index( [
            'index' => self::INDEX_CHANNELS,
            'id' => $id,
            'body' => [
                'title' => $title,
            ],
        ] );
    }

    public function addVideo( string $channel_id, string $id, string $likes, string $dislikes ) : void
    {
        $this->elasticsearch->index( [
            'index' => self::INDEX_VIDEOS,
            'id' => $id,
            'body' => [
                'channel' => $channel_id,
                'likes' => $likes,
                'dislikes' => $dislikes,
            ],
        ] );
    }

    public function getChannel( $id ) : array
    {
        $params = [
            'index' => self::INDEX_CHANNELS,
            'id' => $id,
        ];
        $response = $this->elasticsearch->getSource($params);

        $data = array();
        $data['title'] = $response['title'];

        return $data;
    }

    public function getChannelsList() : array
    {
        $params = [
            'index' => self::INDEX_CHANNELS,
            'body'  => [
                'query' => [
                    'match_all' => new \stdClass()
                ]
            ]
        ];

        $response = $this->elasticsearch->search($params);

        $channels = array();

        foreach ( $response['hits']['hits'] as $hit )
        {
            $channels[] = array(
                'id' => $hit['_id'],
                'title' => $hit['_source']['title'],
            );
        }

        return $channels;
    }
}

