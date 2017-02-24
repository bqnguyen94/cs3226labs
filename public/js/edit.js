function updateSums() {

    var sum_mc = 0;
    var sum_tc = 0;
    var sum_hw = 0;
    var sum_pb = 0;
    var sum_ks = 0;
    var sum_ac = 0;

    $('input[name^="mc"]').each(function() {
        sum_mc += $.isNumeric($(this).val()) ? parseFloat($(this).val()) : 0;
    });
    $('input[name^="tc"]').each(function() {
        sum_tc += $.isNumeric($(this).val()) ? parseFloat($(this).val()) : 0;
    });
    $('input[name^="hw"]').each(function() {
        sum_hw += $.isNumeric($(this).val()) ? parseFloat($(this).val()) : 0;
    });
    $('input[name^="pb"]').each(function() {
        sum_pb += $.isNumeric($(this).val()) ? parseInt($(this).val()) : 0;
    });
    $('input[name^="ks"]').each(function() {
        sum_ks += $.isNumeric($(this).val()) ? parseInt($(this).val()) : 0;
    });
    $('input[name^="ac"]').each(function() {
        sum_ac += $.isNumeric($(this).val()) ? parseInt($(this).val()) : 0;
    });

    $('#sum-mc').text(sum_mc);
    $('#sum-tc').text(sum_tc);
    $('#sum-hw').text(sum_hw);
    $('#sum-pb').text(sum_pb);
    $('#sum-ks').text(sum_ks);
    $('#sum-ac').text(sum_ac);
    $('#sum').text(sum_mc + sum_tc + sum_hw + sum_pb + sum_ks + sum_ac);
}

$(document).ready(updateSums);
$('.score-input').change(updateSums);
