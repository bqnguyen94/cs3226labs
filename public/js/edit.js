var sum_mc = 0;
var sum_tc = 0;
var sum_hw = 0;
var sum_pb = 0;
var sum_ks = 0;
var sum_ac = 0;

document.getElementById('sum').style.fontWeight = 'bold';

function updateSums() {
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

    $('#sum-mc').text(sum_mc);
    $('#sum-tc').text(sum_tc);
    $('#sum-hw').text(sum_hw);
    $('#sum-pb').text(sum_pb);
    $('#sum-ks').text(sum_ks);
    updateTotalSum();
}

$(document).ready(updateSums);
$('.score-input').change(updateSums);

function add_ac_fields() {
    ac++;
    var objTo = document.getElementById('achievement-panel')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass" + ac);
	var rdiv = 'removeclass' + ac;
    divtest.innerHTML = '<div class="row achievement-row"><div class="col-sm-3 nopadding"><div class="form-group has-feedback"><div class="input-group"><div class="input-group-btn"><button class="btn btn-danger" type="button"  onclick="remove_ac_fields(' + ac + ');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div><select class="form-control dropdown" id="ac_type" name="ac_types[]" required><option selected="selected" value="">Achievement</option><option value="1">Let it begins</option><option value="2">Quick starter</option><option value="3">Active in class</option><option value="4">Surprise us</option><option value="5">High determination</option><option value="6">Bookworm</option><option value="7">Kattis apprentice</option><option value="8">CodeForces Specialist</option></select></div><span class="glyphicon form-control-feedback" aria-hidden="true"></span><div class="help-block with-errors"></div></div></div><div class="col-sm-2 nopadding"><div class="form-group has-feedback"><select class="form-control dropdown" id="ac_week" name="ac_weeks[]" required><option selected="selected" value="">Week</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select><span class="glyphicon form-control-feedback" aria-hidden="true"></span><div class="help-block with-errors"></div></div></div><div class="col-sm-7 nopadding"><div class="form-group has-feedback"><input type="text" class="form-control" id="ac_reason" name="ac_reasons[]" value="" placeholder="Reason" maxlength="30" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span><div class="help-block with-errors"></div></div></div></div>';

    objTo.appendChild(divtest);
    $('form').validator('update');
    $('#sum').text(sum_mc + sum_tc + sum_hw + sum_pb + sum_ks + ac);
    updateTotalSum();
}
function remove_ac_fields(rid) {
   $('.removeclass' + rid).remove();
   $('form').validator('update');
   updateTotalSum();
}
$('#btn-submit').on('click', function() {
    $('form').validator('validate');
});

function updateTotalSum() {
    $('#sum').text((sum_mc + sum_tc + sum_hw + sum_pb + sum_ks + $('.achievement-row').length));
}
