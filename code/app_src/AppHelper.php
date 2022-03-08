<?php

namespace App;

class AppHelper
{
    private $request;

    public function __construct($request)
    {
      $this->request = $request;
    }

    public function getRequestBody()
    {
      if (!isset($this->request['index'])) {
        throw new \Exception('No index passed');
      }

      switch ($this->request['index']) {
        case 'youtube_channel':
          return $this->makeChannelArray();

        case 'youtube_video':
          return $this->makeVideoArray();

        default:
          throw new \Exception('Wrong index passed');

      }
    }

    private function makeChannelArray()
    {
      return [
        'index' => $this->request['index'],
        'id'    => $this->request['id'],
        'body'  => [
          'channel_id'   => $this->request['id'],
          'channel_name' => $this->request['name']
        ]
      ];
    }

    private function makeVideoArray()
    {
      return [
        'index' => $this->request['index'],
        'id'    => $this->request['id'],
        'body'  => [
          'video_id'   => $this->request['id'],
          'title'      => $this->request['name'],
          'likes'      => $this->request['video_likes'],
          'dislikes'   => $this->request['video_dislikes'],
          'channel_id' => $this->request['video_channel_id'],
        ]
      ];
    }
}
