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

  #add_event {
    visibility: visible;
  }

  #user_request {
    visibility: hidden;
  }

  .content {
    display: inline-block;
    width: 50%;
  }

  #content {
    display: flex;
    align-content: space-between;
    width: 500px;
  }
</style>
</head>
<body>
<div class="wrapper">
    <h1>Домашняя работа 11</h1>
    <form action="app.php" method="post" target="send">
      <div id="content">
        <div id="content_left" class="content">
          <label for="action">
              Действие
          </label></br>
          <select name="action" id="action" onChange="show(this)">
            <option>Добавить</option>
            <option>Удалить</option>
            <option>Запрос</option>
          </select></br>
          <label for="storage">
              Хранилище
          </label></br>
          <select name="storage" id="storage">
            <option>ElasticSearch</option>
            <option>Redis</option>
          </select></br>
          <input type="submit" value="Выполнить">
        </div>
        <div id="content_right" class="content">
          <div id="add_event">
            <label for="priority">
                Priority
            </label></br>
            <input type="text" name="priority" id="priority"></br>

            <label for="conditions">
                Conditions
            </label></br>
            <input type="textarea" name="conditions" id="conditions"></br>

            <label for="event">
                Event
            </label></br>
            <input type="text" name="event" id="event"></br>
          </div>
          <div id="user_request">
            <label for="user_params">
                Params
            </label></br>
            <input type="textarea" name="user_params" id="user_params"></br>
          </div>
        </div>
      </div>
    </form>
</div>
<script>
  function show(elem) {

    if (elem.value == 'Добавить') {
      document.getElementById('add_event').style.visibility = 'visible';
      document.getElementById('user_request').style.visibility = 'hidden';
    } else if (elem.value == 'Очистить') {
      document.getElementById('add_event').style.visibility = 'hidden';
      document.getElementById('user_request').style.visibility = 'hidden';
    } else if (elem.value == 'Запрос') {
      document.getElementById('add_event').style.visibility = 'hidden';
      document.getElementById('user_request').style.visibility = 'visible';
    }
  }
</script>
</body>
</html>
