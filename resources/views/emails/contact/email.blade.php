<html dir="ltr" lang="pt-BR">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>
</head>

<body style="margin:0; background-color:#eee;">

<div style="background-color:#eee; width:100%; padding:30px 0 100px 0; height:100%;">

    <center>
        <div style="margin:0 auto; width:100%; max-width:620px; background-color: #fff;-webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; box-shadow: 0px 0px 5px rgba(0,0,0,0.1)" >
            <img src="{{ config('app.url') }}/assets/img/header.jpg" style="width:100%; max-width: 620px; border:0; margin-top:0; margin-bottom: 10px; -webkit-border-top-right-radius: 20px; -webkit-border-top-left-radius: 20px; -moz-border-radius-topright: 20px; -moz-border-radius-topleft: 20px; border-top-right-radius: 20px; border-top-left-radius: 20px;">
            <div style="padding:20px; text-align:justify; color:#666; line-height:150%; font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:13px;">
                <!-- Content -->
                <h2 style=" color: #222;">Você recebeu um contato via site!</h2>
                <p>Email do contato: {{ $email }}</p>
                <p>Nome do contato: {{ $name }}</p>
                <p>Assunto: {{ $subject }}</p>
                <p>Mensagem: {{ $message }}</p>
            </div>
        </div>
    </center>
</div>

</body>
</html>
