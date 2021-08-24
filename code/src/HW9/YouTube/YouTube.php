<?php

namespace HW9\YouTube;

use Exception;

Class YouTube 
{
	private const SEARCH_LIST_MAX_RESULTS = 50;
	private $api_key = null;
	private $app_name = null;
	private $service = null;
	
	public function __construct( string $api_key, string $app_name )
	{
		if ( empty( $api_key ) )
		{
			throw new Exception( 'Please provide an API key' );
		}
		if ( empty( $app_name ) )
		{
			throw new Exception( 'Please provide an application name' );
		}
		
		$this->app_name = $app_name;
		$this->api_key = $api_key;
		
		$this->getService();
	}
	
	private function getService() : void
	{
		$client = new \Google\Client();
		$client->setApplicationName( $this->app_name );
		$client->setDeveloperKey( $this->api_key );
	 
		$this->service = new \Google\Service\YouTube($client);
	}
	
	public function getVideos( $channel_id ) : array
	{
		$ids = array();
		
		$list_search = $this->getVideoListSearch( $channel_id, self::SEARCH_LIST_MAX_RESULTS );

		$ids = array_merge( $ids, $list_search['ids'] );

		while ( !empty( $list_search['next_page'] ) )
		{
			$list_search = $this->getVideoListSearch( $channel_id, self::SEARCH_LIST_MAX_RESULTS, $list_search['next_page'] );
			$ids = array_merge( $ids, $list_search['ids'] );
		}
		
		return $ids;
	}
	
	private function getVideoListSearch( $channel_id, $max_results, $next_page = null ) : array
	{
		$params = array(
			'channelId' => $channel_id,
			'maxResults' => $max_results,
		);
		if ( $next_page )
		{
			$params['pageToken'] = $next_page;
		}
		
		$response = $this->service->search->listSearch('id', $params );
		
		$videos = array();
		
		foreach ( $response->items as $video )
		{
			if ( $video['id']->kind === 'youtube#video' )
			{
				$videos[$video['id']->videoId] = array(
					'likes' => 0,
					'dislikes' => 0,
				);
			}
		}
		
		$this->getVideoStatistics( $videos );
		
		return array(
			'next_page' => $response->nextPageToken,
			'ids' => $videos,
		);
	}
	
	
	private function getVideoStatistics( array &$videos ) : void
	{
		$response = $this->service->videos->listVideos('statistics', [
			'id' => implode( ',', array_keys( $videos ) ),
		]);
		
		foreach ( $response->items as $item )
		{
			$videos[ $item->id ]['likes'] = $item->statistics->likeCount;
			$videos[ $item->id ]['dislikes'] = $item->statistics->dislikeCount;
		}
	}
	
	public function getChanelInfo( $channel_id ) : array
	{
		$r = $this->service->channels->listChannels( 'snippet', array(
			'id' => $channel_id,
		) );

		return array(
			'title' => $r->items[0]->snippet->title,
		);
	}
}

