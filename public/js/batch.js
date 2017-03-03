$("#choose-category").change(function() {
    var dropdown = $(this);
    var key = dropdown.val();
    var vals = [];
    var regex = "";
    var placeholder = "";
    var disabled = "";
    var data_pattern_error = "";

    switch(key) {
        case 'mc':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            regex = "(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0";
            placeholder = "x.y";
            data_pattern_error = "Score must be 0 to 4 and % 0.5 == 0 lah! Or just x.y can also!";
            break;
        case 'tc':
            vals = [1, 2];
            regex = "(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0";
            placeholder = "x.y";
            data_pattern_error = "Score must be 0 to 4 and % 0.5 == 0 lah! Or just x.y can also!";
            break;
        case 'hw':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            regex = "(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0";
            placeholder = "x.y";
            data_pattern_error = "Score must be 0 to 4 and % 0.5 == 0 lah! Or just x.y can also!";
            break;
        case 'pb':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            regex = "(^(?!$)[0-4]?$)|x";
            placeholder = "x";
            data_pattern_error = "Score must be 0 to 4 lah! Or just x can also!";
            break;
        case 'ks':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            regex = "(^(?!$)[0-4]?$)|x";
            placeholder = "x";
            data_pattern_error = "Score must be 0 to 4 lah! Or just x can also!";
            break;
        default:
            vals = ['Choose a category first lah!'];
            regex = "";
            disabled = "disabled";
            data_pattern_error = "";
            break;
    }

    var secondChoice = $("#choose-week");
    secondChoice.empty();
    $.each(vals, function(index, value) {
        secondChoice.append("<option>" + value + "</option>");
    });

    $(".score-input").each(function() {
        $(this).attr({
            'pattern': regex,
            'placeholder': placeholder,
            'data-pattern-error': data_pattern_error,
        });
        $(this).prop('disabled', disabled);
    });

    $('form').validator('update');
});

$('#btn-submit').on('click', function() {
    $('form').validator('validate');
});
