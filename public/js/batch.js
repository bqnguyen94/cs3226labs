$("#choose-category").change(function() {
    var dropdown = $(this);
    var key = dropdown.val();
    var vals = [];

    switch(key) {
        case 'mc':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            break;
        case 'tc':
            vals = [1, 2];
            break;
        case 'hw':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            break;
        case 'pb':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9];
            break;
        case 'ks':
            vals = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
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

});
