$("#achievement").change(function() {
    console.log(true);
    var dropdown = $(this);
    var key = dropdown.val();
    console.log(data[key][0]);
    $('table tbody').empty();

    if (data[key].length == 0) {
        var markup = "<td style='text-align:center'>List is empty!</td>";
        $("table tbody").append(markup);
    }
    for (var i = 0; i < data[key].length; i++) {
        var markup = "<tr><td style='text-align:center'><h3><a href='/student/" + data[key][i].student_id + "'>" + data[key][i].student_name + "</a></h3></td></tr>";
        $("table tbody").append(markup);
    }
});
