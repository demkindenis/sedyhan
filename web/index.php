<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Седых спизди</title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
  <div id="chat">
    в чат
    <select class="chat_select" name="chat">
      <option value="533910">Денису</option>
      <option value="-1001149670525" selected>Грекос (Grekos)</option>
      <option value="-1001343417872">Друзяшкам</option>
    </select>
    </div>
  Седых спизди <input id="text" type="text" name="text"><span id="say">Пиздануть</span>

  <script>
    $(document)
      .on('click', '#say', function() {
        var text = encodeURIComponent($('#text').val());
        var url  = 'https://api.telegram.org/bot566295728:AAFrqfGoM1P7FQxlEs2cjHbX9V747bIgH_k/sendMessage?chat_id='+$('#chat .chat_select').val()+'&parse_mode=html&text='+text;
        $.post(url, function() {
          alert('я пизданул');
        });
      })
  </script>

  <style>
    #say {
      text-decoration: underline;
      color: rgb(99, 128, 34);
      margin-left: 10px;
    }

    #chat {
      position: fixed;
      right: 10px
    }
    .chat_select {
      margin-left: 10px;
    }

  </style>
</body>
</html>