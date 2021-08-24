<?php

namespace HW9\Search;

use Exception;
use HW9\YouTube\Channel;

Class Statistics extends Search
{
	private $limit = 3;

	public function setLimit( integer $limit ) : void
	{
		$this->limit = $limit;
	}

	public function top() : array
	{
		$params = [
			'index' => parent::INDEX_VIDEOS,
			'body'  => [
				'aggs' => [
					'sum_for_channel' => [//agg name
						'terms' => [
							'field' => 'channel',
							'size' => $this->limit,
						],
						'aggs' => [
							'sum_likes' => [
								'sum' => [
									'field' => 'likes',
								],
							],
							'sum_dislikes' => [
								'sum' => [
									'field' => 'dislikes',
								],
							],
							'ratio' => [
								'bucket_script' => [
									'buckets_path' => [
										'var_likes' => 'sum_likes',
										'var_dislikes' => 'sum_dislikes',
									],
									'script' => 'params.var_dislikes / params.var_likes',
								],
							],
							'sort_by_ratio' => [
								'bucket_sort' => [
									'sort' => [
										'ratio' => [
											'order' => 'asc',
										],
									],
								],
							],
						],
					],
				],
			],
		];
		
		
		$response = $this->elasticsearch->search($params);
		
		$ratios = array();
		foreach ( $response['aggregations']['sum_for_channel']['buckets'] as $bucket )
		{
			$ratios[] = array(
				'id_channel' => $bucket['key'],
				'ratio' => $bucket['ratio']['value'],
			);
		}
		
		return $ratios;
	}
	
	public function getChannelSum( $id_channel ) : array
	{
		$params = [
			'index' => parent::INDEX_VIDEOS,
			'body'  => [
				'aggs' => [
					'sum_for_channel' => [//agg name
						'terms' => [
							'field' => 'channel',
						],
						'aggs' => [
							'sum_likes' => [
								'sum' => [
									'field' => 'likes',
								],
							],
							'sum_dislikes' => [
								'sum' => [
									'field' => 'dislikes',
								],
							],
						],
					],
				],
				'query' => [
					'match' => [
						'channel' => $id_channel,
					]
				],
			],
		];
		
		$response = $this->elasticsearch->search($params);
		
		$sums = array(
			'likes' => (int) $response['aggregations']['sum_for_channel']['buckets'][0]['sum_likes']['value'],
			'dislikes' => (int) $response['aggregations']['sum_for_channel']['buckets'][0]['sum_dislikes']['value'],
		);
		
		return $sums;
	}

	public function showForChannel( Channel $channel) : void
    {
        echo 'Statistics for channel "' . $channel->getTitle() . '"' . "\r\n";
        echo 'Likes: ' . $channel->getLikes() . "\r\n";
        echo 'Dislikes: ' . $channel->getDislikes() . "\r\n";
    }

    public function showTop( array $top_result ) : void
    {
        foreach ( $top_result as $place => $hit )
        {
            $channel = $this->getChannel( $hit['id_channel'] );

            echo 'Place #' . ($place + 1) . ': ' . $channel['title'] . ', ratio ' . $hit['ratio'] . "\r\n";
        }
    }
}

