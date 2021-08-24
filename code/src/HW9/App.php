<?php

namespace HW9;

use Exception;
use Elasticsearch\ClientBuilder;
use HW9\Search\Statistics;
use HW9\Search\Search;
use HW9\YouTube\Video;
use HW9\YouTube\YouTube;
use HW9\YouTube\Channel;

Class App 
{
	private $channels = [];
	private $youtube = null;
	private $elasticsearch = null;
    private $search = null;

	public function run( array $argv ) : void
	{
		if ( empty($argv[1]) )
		{
			$e = 'Missing app type.' . "\r\n";
			$e .= 'Usage:' . "\r\n";
			$e .= ' - php app.php index - to index the list of videos;' . "\r\n";
			$e .= ' - php app.php stats - to get each channels\' statistics;' . "\r\n";
			$e .= ' - php app.php top - to get top 3 channels by likes/dislikes ratio.' . "\r\n";
			
			throw new Exception( $e );
		}
		
		$type = $argv[1];
		
		switch ( $type )
		{
			case 'index':
				$this->initYoutube();
				$this->initElasticsearch();

				$this->search = new Search( $this->elasticsearch );
                $ELASTICSEARCH_MAPPING = getenv('ELASTICSEARCH_MAPPING', true) ?: getenv('ELASTICSEARCH_MAPPING');
                $this->search->initIndexes($ELASTICSEARCH_MAPPING);
				$this->fillIndexes();
				break;
				
			case 'stats':
				$this->initElasticsearch();
                $this->search = new Search( $this->elasticsearch );

				$stat = new Statistics( $this->elasticsearch );
				
				$this->getChannelsFromIndex();
				
				foreach ( $this->channels as &$channel )
				{
					$sum = $stat->getChannelSum( $channel->getId() );
					$channel->setLikes( $sum['likes'] );
					$channel->setDislikes( $sum['dislikes'] );

					$stat->showForChannel($channel);
				}
				
				break;
			case 'top':
				$this->initElasticsearch();
                $this->search = new Search( $this->elasticsearch );

				$stat = new Statistics( $this->elasticsearch );

				if ( !empty($argv[2]) )
				{
					$stat->setLimit($argv[2]);
				}
				
				$top = $stat->top();
				$stat->showTop( $top );

				break;
			default:
				throw new Exception( 'Wrong app type.' );
				break;
		}
		
	}
	
	private function getChannelsFromIndex() : void
	{
		$channel_list  = $this->search->getChannelsList();

		foreach ( $channel_list as $channel_data )
		{
			$channel = new Channel();
			$channel->setId( $channel_data['id'] );
			$channel->setTitle( $channel_data['title'] );
			
			$this->channels[] = $channel;
		}
	}
	
	private function fillIndexes() : void
	{
		$this->retrieveChannelsFromFile();
		$this->retrieveChannelsInfo();
		$this->retrieveVideosForChannels();
		$this->index();
	}
	
	private function retrieveVideosForChannels() : void
	{
		foreach ( $this->channels as &$channel )
		{
			$videos = $this->youtube->getVideos( $channel->getId() );
			foreach ( $videos as $id_video => $video_stats )
            {
                $video = new Video( $id_video );
                $video->setChannelId( $channel->getId() );
                $video->setLikes( $video_stats['likes'] );
                $video->setDislikes( $video_stats['dislikes'] );

                $channel->addVideo( $video );
                $channel->addLikes( $video->getLikes() );
                $channel->addDislikes( $video->getDislikes() );
            }
		}
	}

	private function index() : void
	{
	    foreach ( $this->channels as $channel )
		{
		    $this->search->addChannel( $channel->getId(), $channel->getTitle() );

            foreach ( $channel->videos as $video )
			{
			    $this->search->addVideo( $video->getChannelId(), $video->getId(), $video->getLikes(), $video->getDislikes() );

                $channel->addLikes( $video->getLikes() );
                $channel->addDislikes( $video->getDislikes() );
			}
		}
	}
	
	private function initYoutube() : void
	{
		$APP_NAME = getenv('APP_NAME', true) ?: getenv('APP_NAME');
		$YOUTUBE_API_KEY = getenv('YOUTUBE_API_KEY', true) ?: getenv('YOUTUBE_API_KEY');
		
		$this->youtube = new YouTube( $YOUTUBE_API_KEY, $APP_NAME );
	}
	
	private function initElasticsearch() : void
	{
		$ELASTICSEARCH_HOST = getenv('ELASTICSEARCH_HOST', true) ?: getenv('ELASTICSEARCH_HOST');

		$this->elasticsearch = ClientBuilder::create()
			->setHosts( array( $ELASTICSEARCH_HOST ) )
			->build();
	}
	

	private function retrieveChannelsFromFile() : void
	{
		$src = getenv('CHANEL_LIST_JSON', true) ?: getenv('CHANEL_LIST_JSON');
		
		if ( !file_exists( $src ) )
		{
			throw new Exception( 'Channel list JSON file not available, file name given: ' . $src );
		}
		
		$links = json_decode( file_get_contents( $src ), 1 );
		
		if ( empty( $links ) )
		{
			throw new Exception( 'Read zero channels from file ' . $src );
		}
		
		foreach ( $links as $link )
		{
			$channel = new Channel( $link );
			
			$this->channels[] = $channel;
		}
		
	}
	
	private function retrieveChannelsInfo() : void
	{
		foreach ( $this->channels as &$channel )
		{
			$info = $this->youtube->getChanelInfo( $channel->getId() );
			
			if ( empty( $info['title'] ) )
			{
				continue;
			}
			$channel->setTitle( $info['title'] );
		}
		
	}
}

