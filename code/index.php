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
            <option>Insert</option>
            <option>Select</option>
            <option>Select All</option>
            <option>Update</option>
            <option>Delete</option>
          </select></br>
          <input type="submit" value="Выполнить">
        </div>
        <div id="content_right" class="content">
          <div id="data">
            <label for="id">
                Id
            </label></br>
            <input type="text" name="id" id="id"></br>
            <label for="name">
                Name
            </label></br>
            <input type="text" name="name" id="name"></br>
            <label for="class">
                Class
            </label></br>
            <input type="text" name="class" id="class"></br>
            <label for="race">
                Race
            </label></br>
            <input type="text" name="race" id="race"></br>
          </div>
          <div id="select_condition">
            <label for="field">
                Condition
            </label></br>
            <select name="field" id="field">
              <option>id</option>
              <option>hero_name</option>
              <option>hero_class</option>
              <option>hero_race</option>
            </select></br>
          </div>
        </div>
      </div>
    </form>
</div>
<script>
  function show(elem) {

    if (elem.value == 'Select All') {
      document.getElementById('data').style.visibility = 'hidden';
    } else {
      document.getElementById('data').style.visibility = 'visible';
    }
  }
</script>
</body>
</html>
