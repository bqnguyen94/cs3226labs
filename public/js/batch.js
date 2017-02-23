$("#choose-category").change(function() {
    var dropdown = $(this);
    var key = dropdown.val();
    var vals = [];
    var regex = "";
    var placeholder = "";

    switch(key) {
        case 'mc':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            regex = "(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0";
            placeholder = "x.y";
            break;
        case 'tc':
            vals = [1, 2];
            regex = "(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0";
            placeholder = "x.y";
            break;
        case 'hw':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            regex = "(^(?!$)[0-3](?:[,.][05])?$)|x.y|4|4.0";
            placeholder = "x.y";
            break;
        case 'pb':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            regex = "(^(?!$)[0-4]?$)|x";
            placeholder = "x";
            break;
        case 'ks':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            regex = "(^(?!$)[0-4]?$)|x";
            placeholder = "x";
            break;
        default:
            vals = ['Choose a category first lah!'];
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
        });
    });

});
