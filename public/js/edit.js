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

var ac = 0;
function education_fields() {
    ac++;
    var objTo = document.getElementById('achievement-panel')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass" + ac);
	var rdiv = 'removeclass' + ac;
    divtest.innerHTML = '<div class="row"><div class="col-sm-3 nopadding"><div class="form-group has-feedback"><div class="input-group"><div class="input-group-btn"><button class="btn btn-danger" type="button"  onclick="remove_education_fields('+ ac +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div><select class="form-control dropdown" id="ac_type" name="ac_types[]"><option selected="selected" value="">Achievement</option><option value="1">Let it begins</option><option value="2">Quick starter</option><option value="3">Active in class</option><option value="4">Surprise us</option><option value="5">High determination</option><option value="6">Bookworm</option><option value="7">Kattis apprentice</option><option value="8">CodeForces Specialist</option></select></div></div></div><div class="col-sm-2 nopadding"><div class="form-group has-feedback"><select class="form-control dropdown" id="ac_star" name="ac_stars[]"><option selected="selected" value="">Stars</option></select></div></div><div class="col-sm-2 nopadding"><div class="form-group has-feedback"><select class="form-control dropdown" id="ac_week" name="ac_weeks[]"><option selected="selected" value="">Week</option></select></div></div><div class="col-sm-5 nopadding"><div class="form-group"><input type="text" class="form-control" id="ac_reason" name="ac_reasons[]" value="" placeholder="Reason"></div></div></div>';

    objTo.appendChild(divtest)
}
function remove_education_fields(rid) {
   $('.removeclass'+rid).remove();
}
