$(function () {
    $('.datetime').mask('00/00/0000 00:00:00');
    $('.date').mask('00/00/0000');
    $('.cellphone').mask('(00) 00000-0000');
    $('.phone').mask('(00) 0000-0000');
    $('.cpf').mask('000.000.000-00');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});
