$(document).ready(function() {
    var table = $('#ranktable').DataTable({
        paging: false,
        autoWidth: false,
        searching: false,
        search: [{
            smart: false,
        }],
        info: false,
        order: [
            [12, 'desc']
        ],
        columnDefs: [{
            targets: [0],
            orderable: false,
        }],
        jQueryUI: false
    });

    table.on('order.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1;
            cell.style.textAlign = "center";
        } );
    }).draw();

    $('tbody tr').each(function(index) {
        cur = $(this).find('td:nth-child(13)').text();
        next = $(this).next('tr').find('td:nth-child(13)').text();
        if (next.length > 0) { // if next row exists, change next row's height depending on sum difference
            $(this).next().height($(this).next().height() + (cur - next) * 30);
        }
    });

    table.on('click', 'thead th', function() {
        var colIndex = table.column(this).index() + 1;
        if (colIndex >= 4 && colIndex <= 13) {
            $('tbody tr').each(function() {
                //console.log(true);
                $(this).height(37);
            });
            console.log(colIndex);
            $('tbody tr').each(function() {
                cur = $(this).find('td:nth-child(' + colIndex + ')').text();
                next = $(this).next('tr').find('td:nth-child(' + colIndex + ')').text();
                if (next.length > 0) { // if next row exists, change next row's height depending on sum difference
                    $(this).next().height($(this).next().height() + Math.abs(cur - next) * 30);
                }
            });
        } else {
            $('tbody tr').each(function() {
                //console.log(true);
                $(this).height(37);
            });
        }
    })

    $('#ranktable tbody').on('mouseleave', 'td', function() {
        $(table.cells().nodes()).removeClass('highlight');
    });

    // on clicking a header to sort, all cells revert to the same default height
    // this function can only be invoked once
    $('thead').one('click', function() {
        $('tbody tr').each(function() {
            //console.log(true);
            $(this).height(37);
        });
    });
});
