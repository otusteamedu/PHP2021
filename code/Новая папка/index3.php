<?php

require_once('vendor/autoload.php');

// use App\App;

// try {
//     $app = new App();
//     $app->run();
// } catch (Exception $e) {
//     echo $e->getMessage();
// }

class YoutubeAPI {

    private $googleKey;

    public function __construct($googleKey)
    {
        $this->googleKey = $googleKey;
    }
    
    private $googleKey = 'AIzaSyCcd1DDHz5G2SroG3gTurb2f3LHJgvBwjo';

    public function informationAboutTheChannel($idChannel) {
        $json_result = file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=contentDetails,statistics&id=$idChannel&key=$this->googleKey");
        $obj = json_decode($json_result);
        return $obj;
    }

    public function allIdVideo($idUploads, $videoCount) {
        $maxResults = '50';
        // Количество проходов
        $countPasses = ceil($videoCount / $maxResults);
        $idVideo = array();
        $idNextPage = "";
        $a = 0;

        do {
            $json_result = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=$idUploads&maxResults=$maxResults&key=$this->googleKey&pageToken=$idNextPage");
            $obj = json_decode($json_result);

            if ($a == $countPasses-1) {
                // id следующей страницы
                $idNextPage = "";
            } else {
                $idNextPage = $obj->nextPageToken;
            }

            // получение id видео
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
// // $googleKey = 'AIzaSyCcd1DDHz5G2SroG3gTurb2f3LHJgvBwjo';

$date = new YoutubeAPI;
$idChannel = "UC9xYunBUEYI2-3HtRH4QGmw";
$informationChannel = $date->informationAboutTheChannel($idChannel);
echo '<pre>', print_r($informationChannel, true), '</pre>';

// $videoCount = $informationChannel->items[0]->statistics->videoCount;
// $idUploads = $informationChannel->items[0]->contentDetails->relatedPlaylists->uploads;

// $idVideo = $date->allIdVideo($idUploads, $videoCount);

// $informationVideo = $date->informationAboutTheVideo($idVideo);


// // Зона еластик
// class Elastic {

//     public function clientBuilder($host) {
//         $client = Elasticsearch\ClientBuilder::create()
//         ->setSSLVerification(false)
//         ->setHosts([$host"elasticsearch:9200"])->build();

//         return $client;
//     }

//     // Создание индекса
//     public function createIndex($indexParams) {
//         $client = $this->clientBuilder();
//         $response = $client->indices()->create($indexParams);
        
//         return $response;
//     }

//     // Добавление документа
//     public function addDocument($indexParams) {
//         $client = $this->clientBuilder();
//         $response = $client->index($indexParams);
        
//         return $response;
//     }
    
//     // Поиск
//     public function search($indexParams)
//     {
//         $client = $this->clientBuilder();
//         $response = $client->search($indexParams);

//         return $response;
//     }
   

// }

// $date = new Elastic;

// // $indexParams = [
// //     'index' => 'video',
// //         'body' => [
// //             'mappings' => [
// //                 'properties' => [
// //                     'id' => [
// //                         'type' => 'text',
// //                     ],
// //                     'title' => [
// //                         'type' => 'text',
// //                     ],
// //                     'viewCount' => [
// //                         'type' => 'integer',
// //                     ],
// //                     'likeCount' => [
// //                         'type' => 'integer',
// //                     ],
// //                     'dislikeCount' => [
// //                         'type' => 'integer'
// //                     ],
// //                 ],
// //             ],
// //         ],
// // ];
// // $client = $date->createIndex($indexParams);

// // $indexParams = [
// //     'index' => 'video',
// //     'body'  => [ 
// //         'id' => '1',
// //         'title' => '1',
// //         'viewCount' => '1',
// //         'likeCount' => '1',
// //         'dislikeCount' => '1'
// //     ]
// // ];

// // $client = $date->addDocument($indexParams);

// // print_r($client);
// $client = Elasticsearch\ClientBuilder::create()
//         ->setSSLVerification(false)
//         ->setHosts(["elasticsearch:9200"])->build();
// $data = $client->search([
//     'size' => '1000',
//     'index' => 'video'
// ]);


// echo '<pre>', print_r($data, true), '</pre>';