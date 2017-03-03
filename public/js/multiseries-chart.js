google.load('visualization', '1.0', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);

function drawChart() {
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Week');

    for (var i = 0; i < json.student_name.length; i++) {
        data.addColumn('number', json.student_name[i]);
    }


    for (var i = 0; i < json.rank.length; i++) {
        var temp = [];
        temp.push((i + 1).toString());
        //console.log(json.rank.length);
        if (json.rank[i].length == data.getNumberOfColumns() - 1) {
            data.addRow(temp.concat(json.scores[i]));
        }
    }

    var columnsTable = new google.visualization.DataTable();
    columnsTable.addColumn('number', 'colIndex');
    columnsTable.addColumn('string', 'colLabel');
    var initState = {
        selectedValues: []
    };
    // put the columns into this data table (skip column 0)
    for (var i = 1; i < data.getNumberOfColumns(); i++) {
        columnsTable.addRow([i, data.getColumnLabel(i)]);
        // you can comment out this next line if you want to have a default selection other than the whole list
        initState.selectedValues.push(data.getColumnLabel(i));
    }
    // you can set individual columns to be the default columns (instead of populating via the loop above) like this:
    // initState.selectedValues.push(data.getColumnLabel(4));

    var chart = new google.visualization.ChartWrapper({
        chartType: 'LineChart',
        containerId: 'chart',
        dataTable: data,
        options: {
            title: 'CS3233 Ranking',
            backgroundColor: 'none',
            legend: {
                position: 'top',
                maxLines: 5
            },
            fontName: 'Tahoma',
            chartArea: {
                width: '85%'
            },
            vAxis: {
                //direction: -1,
                ticks: [0, 5, 10, 15, 20, 25, 30, 35]
            }
        }
    });

    var columnFilter = new google.visualization.ControlWrapper({
        controlType: 'CategoryFilter',
        containerId: 'chartfilter',
        dataTable: columnsTable,
        options: {
            filterColumnLabel: 'colLabel',
            ui: {
                label: '',
                allowTyping: false,
                allowMultiple: true,
                allowNone: false,
                caption: 'Add student',
                selectedValuesLayout: 'below'
            }
        },
        state: initState
    });

    function setChartView() {

        var state = columnFilter.getState();
        var row;
        var view = {
            columns: [0]
        };

        for (var i = 0; i < state.selectedValues.length; i++) {
            row = columnsTable.getFilteredRows([{
                column: 1,
                value: state.selectedValues[i]
            }])[0];
            view.columns.push(columnsTable.getValue(row, 0));
        }
        var colors = ['9d9d9d', 'c1c0c0', 'bb0000', 'ff0000', '001961', '0b4183', '0090d0', '00b4f6', '84cf34', '5ca212', 'a6a600', 'd3d300', '65199e', '03077d', '6d6c91', '9290c5', 'b84a02', 'ff7300', '000000', '444444', 'cd7f7d', 'e9a8a6', , ];
        view.columns.sort(function(a, b) {
            return (a - b);
        });
        chart.getOptions().series = [];
        for (var i = 1; i < view.columns.length; i++) {
            chart.getOptions().series.push({
                color: colors[view.columns[i] - 1]
            });
        }

        view.columns.sort(function(a, b) {
            return (a - b);
        });
        chart.setView(view);
        chart.draw();
    }
    google.visualization.events.addListener(columnFilter, 'statechange', setChartView);

    setChartView();
    columnFilter.draw();
}
/*
$("a[href='#chart']").on('shown.bs.tab', function (e) {
    drawChart();
});
*/
