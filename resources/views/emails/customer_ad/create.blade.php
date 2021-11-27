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
                <img src="{{ config('app.url') }}/assets/img/header-email.png" style="width:100%; max-width: 620px; border:0; margin-top:0; margin-bottom: 10px; -webkit-border-top-right-radius: 20px; -webkit-border-top-left-radius: 20px; -moz-border-radius-topright: 20px; -moz-border-radius-topleft: 20px; border-top-right-radius: 20px; border-top-left-radius: 20px;">
                <div style="padding:0px 40px; text-align:justify; color:#666; line-height:150%; font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:13px;">
                    <br><br>
                    <!-- Tittle -->
                    <h1 style="margin:0 0 30px 0; color:#222; font-size:22px; font-family:'Roboto','Helvetica',Arial,sans-serif; font-weight:900; text-transform: uppercase;">
                        Ei, {{ $name }}.
                    </h1>

                    <!-- Content -->
                    <h2 style=" color: #222;">Seu anúncio está em <strong style="color:#ff8800;">Fase de Aprovação</strong>.</h2>
                    <p>Fique tranquilo, nós te enviaremos um e-mail assim que seu anúncio mudar de status.</p>

                    <div style="width: 100%; min-height: 150px; padding: 20px 0; margin: 30px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee;">
                        <img src="{{ $cover }}" style="display: block; float: left; margin-right: 10px; width: 150px;">
                        <p style="font-size: 20px; color: #222;">
                            <strong>{{ $title }}</strong> <br>
                            <small style="color:#ff8800;">R$ {{ $value }}</small>
                        </p>
                        <p>{{ $type }}, {{ $condition }}</p>
                    </div>

                    <div style="width: 100%; padding: 4px 0; text-align: center;">
                        <a href="{{ $adUrl }}" style="background-color: #ff8800; color: #fff; text-decoration: none; padding: 6px 14px; font-size: 16px; font-weight: bold; -webkit-border-radius: 40px; -moz-border-radius: 40px; border-radius: 40px; margin:0 auto;">VER O ANÚNCIO</a>
                    </div>
                </div>
                <div style="display:block; position:relative; padding: 0 40px 40px 40px; text-align:left; color:#666; text-decoration:none; font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:11px;" >
                    <hr style="height:1px; margin:30px 0; border-top: 1px dashed #ddd; border-bottom: 0; background:none;">
                    Atenciosamente,
                    <a href="{{ config('app.url') }}" style="display:block; padding:2px 0; color:#b06758; text-decoration:none;
                    font-family:'Roboto','Helvetica',Arial,sans-serif; font-size:14px; font-weight:600;" >{{ config('app.company.name') }}</a>
                </div>
            </div>
        </center>
    </div>

    </body>
</html>
