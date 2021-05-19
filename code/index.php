<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otus homework 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <style>
        #errorAlert, #successAlert{
            display: none;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="alert alert-danger mt-5" role="alert" id="errorAlert">Введите текст сообщения и проверьте что кол-во открытых и закрытых скобок соответствует</div>
            <div class="alert alert-success mt-5" role="alert" id="successAlert">Все хорошо, сообщение отправлено</div>
            <div class="bg-light p-5 rounded mt-3">
                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Сообщение</label>
                    <input type="message" class="form-control" name="message">
                </div>
                <button type="submit" class="btn btn-primary" id="pushMessage">Отправить</button>
               
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $( document ).ready(function(){

       

        $('#pushMessage').click(function(){

            let message = $('[name=message]').val();

            $.ajax({
                method: "POST", 
                url: "classes/Messages.php", 
                data: { 
                    message: message
                },
                statusCode: { 
                    200: function(){ 
                        $('#errorAlert').fadeOut();
                        $('#successAlert').fadeIn();
                    },
                    400: function(){ 
                        $('#errorAlert').fadeIn();
                        $('#successAlert').fadeOut();
                    },
                    
                }
            })
        });
        


    });
    </script>

</body>
</html>

