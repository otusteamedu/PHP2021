<?php
// Создание индекса
// $response = $client->indices()->create($params);
// Добавление индекса
// $response = $client->index($params);


require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()
    ->setSSLVerification(false)
    ->setHosts(["elasticsearch:9200"])->build();

// $indexParams = [
//     'index' => 'channel',
//     'body'  => [ 
//         'id' => '1',
//         'viewCount' => '1',
//         'subscriberCount' => '1',
//         'videoCount' => '1'
//     ]
// ];

$indexParams = [
    'index' => 'video',
        'body' => [
            'mappings' => [
                'properties' => [
                    'id' => [
                        'type' => 'text',
                    ],
                    'title' => [
                        'type' => 'text',
                    ],
                    'viewCount' => [
                        'type' => 'integer',
                    ],
                    'likeCount' => [
                        'type' => 'integer',
                    ],
                    'dislikeCount' => [
                        'type' => 'integer'
                    ],
                ],
            ],
        ],
];

// $indexParams = [
//     'index' => 'video',
//     'body'  => [ 
//         'id' => '1',
//         'title' => '1',
//         'viewCount' => '1',
//         'likeCount' => '1',
//         'dislikeCount' => '1'
//     ]
// ];

// $response = $client->index($indexParams);
// print_r($response);

// $response = $client->indices()->create($indexParams);
//      print_r($response);

// $client = Elasticsearch\ClientBuilder::create()
//     ->setSSLVerification(false)
//     ->setHosts(["elasticsearch:9200"])->build();

$data = $client->search([
    'index' => 'video'
]);

echo '<pre>', print_r($data, true), '</pre>';


// $indexParams = [
//     'index' => 'my_index3',
//     'body' => [
//         'settings' => [
//             'number_of_shards' => 5,
//             'number_of_replicas' => 1
//         ]
//     ]
// ];







// $client = Elasticsearch\ClientBuilder::create()
//     ->setSSLVerification(false)
//     ->setHosts(["127.0.0.1:9200"])->build();  
// $response = ''; 
// try {
//     /* Create the index */
//     $response = $client->indices()->create($indexParams);
//     print_r($response);

//     print_r($response);

// } catch(Exception $e) {
//     echo "Exception : ".$e->getMessage();
// }
// die('End : Elastic Search');


// // !!!!!!!!!!!!!!!!!!!!!!!!!!
// // Ключ
// $googleKey = 'AIzaSyCcd1DDHz5G2SroG3gTurb2f3LHJgvBwjo';
// // Id канала
// $idChannel = "UC9xYunBUEYI2-3HtRH4QGmw";
// // Количестов видео в выводе(max 50)
// $maxResults = '50';

// // Запрос на получение информации о канале по id канала
// // $json_result = file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails%2Cstatistics&id=$idChannel&key=$googleKey");
// $json_result1 = file_get_contents("https://youtube.googleapis.com/youtube/v3/channels?part=contentDetails,statistics&id=$idChannel&key=$googleKey");
// $obj1 = json_decode($json_result1);
// echo '<pre>', print_r($obj1, true), '</pre>';

// // id плейлиста со всеми видео
// $idUploads = $obj1->items[0]->contentDetails->relatedPlaylists->uploads;
// $viewCount = $obj1->items[0]->statistics->viewCount;
// $subscriberCount = $obj1->items[0]->statistics->subscriberCount;
// $videoCount = $obj1->items[0]->statistics->videoCount;

// // Количество проходов
// $countPasses = ceil($videoCount / $maxResults);

// $idVideo = array();
// $idNextPage = "";
// $a = 0;

// // do {
// //     $json_result2 = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=$idUploads&maxResults=$maxResults&key=$googleKey&pageToken=$idNextPage");
// //     $obj2 = json_decode($json_result2);

// //     if ($a == $countPasses-1) {
// //         // id следующей страницы
// //         $idNextPage = "";
// //     } else {
// //         $idNextPage = $obj2->nextPageToken;
// //     }

// //     // получение id видео
// //     $idVideos = $obj2->items;
// //     foreach ($idVideos as $Video) {
// //         array_push($idVideo, $Video->snippet->resourceId->videoId);
// //     }
// //     $a++;

// // } while ($a < $countPasses);

// // // print_r($idVideo);
// // // print_r(count($idVideo));


// // for ($i=0; $i < count($idVideo); $i++) { 
// //     $id = $idVideo[$i];
// //     $json_result3 = file_get_contents("https://youtube.googleapis.com/youtube/v3/videos?part=statistics,snippet&id=$id&key=$googleKey");
// //     $obj3 = json_decode($json_result3);
// //     // Название ролика
// //     $title = $obj3->items[0]->snippet->title;
// //     // Количество просмотров
// //     $viewCount = $obj->items[0]->statistics->viewCount;
// //     // Лайки
// //     $likeCount = $obj->items[0]->statistics->likeCount;
// //     // Дизлайки
// //     $dislikeCount = $obj->items[0]->statistics->dislikeCount;
// // }
