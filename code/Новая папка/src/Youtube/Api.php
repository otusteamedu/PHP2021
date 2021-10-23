<?php

namespace Elastic\Youtube;

class Api {

    private $googleKey;

    public function __construct($googleKey)
    {
        $this->googleKey = $googleKey;
    }

    public function informationAboutTheChannel($idChannel) {
        $json_result = file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=contentDetails,statistics&id=$idChannel&key=$this->googleKey");
        $obj = json_decode($json_result);
        return $obj;
    }

    public function allIdVideo($idUploads, $videoCount) {
        $maxResults = '50';
        
        $countPasses = ceil($videoCount / $maxResults);
        $idVideo = array();
        $idNextPage = "";
        $a = 0;

        do {
            $json_result = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=$idUploads&maxResults=$maxResults&key=$this->googleKey&pageToken=$idNextPage");
            $obj = json_decode($json_result);

            if ($a == $countPasses-1) {
                
                $idNextPage = "";
            } else {
                $idNextPage = $obj->nextPageToken;
            }

            $idVideos = $obj->items;
            foreach ($idVideos as $Video) {
                array_push($idVideo, $Video->snippet->resourceId->videoId);
            }
            $a++;

        } while ($a < $countPasses);

        return $idVideo;
    }

    public function informationAboutTheVideo($idVideo) {

        $informationVideo = array();
        for ($i=0; $i < count($idVideo); $i++) { 
            $id = $idVideo[$i];
            $json_result = file_get_contents("https://youtube.googleapis.com/youtube/v3/videos?part=statistics,snippet&id=$id&key=$this->googleKey");
            $obj = json_decode($json_result);
            array_push($informationVideo, $obj);
        }

        return $informationVideo;
    }
}