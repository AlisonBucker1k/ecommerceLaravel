<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Oh, Yes!</title>
</head>

<body style="margin:0; background-color:#e9e3db;">

<div style="background-color:#e9e3db; width:100%; padding:30px 0 100px 0; height:100%;">
    <div style="margin:0 auto; width:100%; max-width:620px; background-color: #fff;-webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; box-shadow: 0px 0px 5px rgba(0,0,0,0.1)" >
        <img src="{{ $baseUrl }}/assets/img/header.jpg" style="width:100%; max-width: 620px; border:0; margin-top:0; margin-bottom: 10px; -webkit-border-top-right-radius: 20px; -webkit-border-top-left-radius: 20px; -moz-border-radius-topright: 20px; -moz-border-radius-topleft: 20px; border-top-right-radius: 20px; border-top-left-radius: 20px;">
        <div style="padding:0px 40px; text-align:justify; color:#666; line-height:150%; font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:13px;">
            <br><br>
            <!-- Tittle -->
            <h1 style="margin:0 0 30px 0; color:#222; font-size:18px; font-family:'Roboto','Helvetica',Arial,sans-serif; font-weight:900; text-transform: uppercase;">Seja bem-vindo.</h1>

            <!-- Content -->
            <p>Para começar a usar a <strong>{{ config('app.company.name') }}</strong>, você precisa confirmar seu endereço de e-mail.</p>
            <p>Clique no botão abaixo para fazer a confirmação e ativar a sua conta.</p>
            <div style="width: 100%; padding: 40px 0; text-align: center;">
                <a href="{{ $actionUrl }}" style="background-color: #b06758; color: #fff; text-decoration: none; padding: 10px 20px; font-size: 18px; font-weight: bold; -webkit-border-radius: 40px; -moz-border-radius: 40px; border-radius: 40px; margin:0 auto;">ATIVAR MINHA CONTA</a>
            </div>
        </div>
        <div style="display:block; position:relative; padding: 0 40px 40px 40px; text-align:left; color:#666; text-decoration:none; font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:11px;" >
            <hr style="height:1px; margin:30px 0; border-top: 1px dashed #ddd; border-bottom: 0; background:none;">
            Atenciosamente,
            <a href="{{ config('app.url') }}" style="display:block; padding:2px 0; color:#b06758; text-decoration:none;
                    font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:14px; font-weight:600;" >{{ config('app.company.name') }}</a>
        </div>
    </div>
</div>

</body>
</html>
