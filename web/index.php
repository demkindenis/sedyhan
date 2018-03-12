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
  <select id="chat" name="chat">
    <option value="533910">Денис</option>
    <option value="-1001149670525">Грекос (Grekos)</option>
  </select>
  Седых спизди <input id="text" type="text" name="text"><span id="say">Пиздануть</span>

  <script>
    $(document)
      .on('click', '#say', function() {
        var text = encodeURIComponent($('#text').val());
        var url  = 'https://api.telegram.org/bot566295728:AAFrqfGoM1P7FQxlEs2cjHbX9V747bIgH_k/sendMessage?chat_id='+$('#chat').val()+'&parse_mode=html&text='+text;
        $.post(url, function() {
          alert('я пизданул');
        });
      })
  </script>
</body>
</html>