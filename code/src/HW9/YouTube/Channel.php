<?php

namespace HW9\YouTube;

use Exception;

Class Channel 
{
    protected $id = null;
	private $title = null;
	protected $likes = 0;
    protected $dislikes = 0;
    public $videos = array();
	
	public function __construct( string $link = null )
	{
		if ( !empty( $link ) )
		{
			$this->setIdFromLink( $link );
		}
	}
	
	private function setIdFromLink( string $link ) : void
	{
		$this->id = end( explode( '/' , $link ) );
	}
	public function setId( string $id ) : void
	{
		$this->id = $id;
	}
	
	public function getId() : string
	{
		return $this->id;
	}
	public function setTitle( string $title ) : void
	{
		$this->title = $title;
	}
	
	public function getTitle() : string
	{
		return $this->title;
	}

    public function addVideo( Video $video ) : void
    {
        $this->videos[] = $video;
    }

	public function addVideos( array $videos ) : void
	{
		$this->videos = array_merge( $this->videos, $videos );
	}
	
	public function setLikes( string $num ) : void
	{
		$this->likes = $num;
	}
    public function addLikes( string $num ) : void
    {
        $this->likes += $num;
    }
	
	public function getLikes() : string
	{
		return $this->likes;
	}
	public function setDislikes( string $num ) : void
	{
		$this->dislikes = $num;
	}
    public function addDislikes( string $num ) : void
    {
        $this->dislikes += $num;
    }
	
	public function getDislikes() : string
	{
		return $this->dislikes;
	}
}

