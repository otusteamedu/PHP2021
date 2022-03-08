<!DOCTYPE HTML>
<html>
<head>
    <style>
        .wrapper {
            position: absolute;
            top: 40%;
            left: 40%;
            margin: -125px 0 0 -125px;
        }
        input, textarea {
            margin-top: 20px;
        }
    </style>
    <style>
  .tabs {
    font-size: 0;
  }

  .tabs>label {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    background-color: #f5f5f5;
    border: 1px solid #e0e0e0;
    padding: 2px 8px;
    font-size: 16px;
    line-height: 1.5;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
    cursor: pointer;
    position: relative;
    top: 1px;
  }

  .tabs>label:not(:first-of-type) {
    border-left: none;
  }

  .tabs>input[type="radio"]:checked+label {
    background-color: #fff;
    border-bottom: 1px solid #fff;
  }

  #video_block {
    visibility: hidden;
  }
</style>
</head>
<body>
<div class="wrapper">
    <h1>Домашняя работа 10</h1>
    <form action="app.php" method="post" target="send">
        <input type="radio" name="tab-btn" id="tab-btn-1" value="info" checked>
        <label for="tab-btn-1">Инфо</label>
        <input type="radio" name="tab-btn" id="tab-btn-2" value="delete">
        <label for="tab-btn-2">Удалить</label>
        <input type="radio" name="tab-btn" id="tab-btn-3" value="add">
        <label for="tab-btn-3">Добавить</label>
        <input type="radio" name="tab-btn" id="tab-btn-4" value="top">
        <label for="tab-btn-4">Топ</label>
        <input type="submit" value="Выполнить">
        <div id="content"></br>
          <label for="channel_index">
              Индекс
          </label></br>
          <select name="index" id="es_index" onChange="show(this)">
            <option>youtube_channel</option>
            <option>youtube_video</option>
          </select></br>
          <label for="name">
              Имя
          </label></br>
          <input type="text" name="name" id="name"></br>
          <label for="id">
              Id
          </label></br>
          <input type="text" name="id" id="id"></br>

          <div id="video_block">
            <label for="video_channel_id">
                Id канала, на котором размещено видео
            </label></br>
            <input type="text" name="video_channel_id" id="video_channel_id"></br>

            <label for="video_likes">
                Лайки
            </label></br>
            <input type="text" name="video_likes" id="video_likes"></br>

            <label for="video_dislikes">
                ДизЛайки
            </label></br>
            <input type="text" name="video_dislikes" id="video_dislikes"></br>
          </div>

        </div>
    </form>
</div>
<script>
  function show(elem) {

    if (elem.value == 'youtube_channel') {
      document.getElementById('video_block').style.visibility = 'hidden';
    } else if (elem.value == 'youtube_video') {
      document.getElementById('video_block').style.visibility = 'visible';
    }
  }
</script>
</body>
</html>
