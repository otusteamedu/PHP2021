<?php
require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()
    ->setSSLVerification(false)
    ->setHosts(["elasticsearch:9200"])->build();

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

// do {
//     $json_result2 = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=$idUploads&maxResults=$maxResults&key=$googleKey&pageToken=$idNextPage");
//     $obj2 = json_decode($json_result2);

//     if ($a == $countPasses-1) {
//         // id следующей страницы
//         $idNextPage = "";
//     } else {
//         $idNextPage = $obj2->nextPageToken;
//     }

//     // получение id видео
//     $idVideos = $obj2->items;
//     foreach ($idVideos as $Video) {
//         array_push($idVideo, $Video->snippet->resourceId->videoId);
//     }
//     $a++;

// } while ($a < $countPasses);

// // print_r($idVideo);
// // print_r(count($idVideo));


// for ($i=0; $i < count($idVideo); $i++) { 
//     $id = $idVideo[$i];
//     $json_result3 = file_get_contents("https://youtube.googleapis.com/youtube/v3/videos?part=statistics,snippet&id=$id&key=$googleKey");
//     $obj3 = json_decode($json_result3);
//     // Название ролика
//     $title = $obj3->items[0]->snippet->title;
//     // Количество просмотров
//     $viewCount = $obj3->items[0]->statistics->viewCount;
//     // Лайки
//     $likeCount = $obj3->items[0]->statistics->likeCount;
//     // Дизлайки
//     $dislikeCount = $obj3->items[0]->statistics->dislikeCount;

//     $indexParams = [
//         'index' => 'video',
//         'body'  => [ 
//             'id' => $id,
//             'title' => $title,
//             'viewCount' => $viewCount,
//             'likeCount' => $likeCount,
//             'dislikeCount' => $dislikeCount
//         ]
//     ];
//     $response = $client->index($indexParams);
// }


$data = $client->search([
    'size' => '1000',
    'index' => 'video'
]);

echo '<pre>', print_r($data, true), '</pre>';


// $indexParams = [
//     'index' => 'video',
//         'body' => [
//             'mappings' => [
//                 'properties' => [
//                     'id' => [
//                         'type' => 'text',
//                     ],
//                     'title' => [
//                         'type' => 'text',
//                     ],
//                     'viewCount' => [
//                         'type' => 'integer',
//                     ],
//                     'likeCount' => [
//                         'type' => 'integer',
//                     ],
//                     'dislikeCount' => [
//                         'type' => 'integer'
//                     ],
//                 ],
//             ],
//         ],
// ];

// $response = $client->indices()->create($indexParams);
//      print_r($response);