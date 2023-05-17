$(document).ready(function (){
    //Procura pela class select2 e para cada que encontrar roda a função
    $('select[data-plugin="select2"]').each(function(i,e){
        $(e).select2({
            placeholder: "Selecione uma Opção",
            dropdownAutoWidth : true,
            allowClear: false
        });
    });

    function format (option) {
        if (!option.id) { return option.text; }
        var obj = option.text + ' | <span>Jose Roberto Romero</span>';	
        return obj;
    }
    $('select[data-plugin="select2-format"]').each(function(i,e){
        $(e).select2({
            placeholder: "Selecione uma Opção",
            allowClear: true,
            templateResult: format,
            templateSelection: function (option) {
                return option.text;
            },
            escapeMarkup: function (m) {
                return m;
            }
        });
    });

});