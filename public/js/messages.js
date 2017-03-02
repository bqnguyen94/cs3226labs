$('#btn-send-reply').on("click", function(e) {
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        id: $('#student_id').val(),
        reply: $('#reply').val(),
    }

    var type = "PUT";
    var url = "./adminPostReply";

    $.ajax({
        type: type,
        url: url,
        data: formData,
        dataType: 'json',
        success: function(data) {
            var message = '<div class="panel-group"><div class="panel panel-default"><div class="panel-heading" data-toggle="collapse" data-target="#message' + data.student_id + '" style="cursor: pointer">Read - ' + data.student_name + '</div><div id="message' + data.student_id + '" class="panel-collapse collapse"><div class="panel-body"><ul class="media-list"><li class="media"><div class="media-body"><a class="pull-left" href="/student/' + data.student_id + '"><img class="media-object img-circle" src="' + data.student_image + '" height="60px" width="60px" style="margin-right: 10px"/></a><div class="media-body">' + data.message + '<br/><small class="text-muted">' + data.student_name + ' | '
            + data.created_at + '</small></div></div></li></ul></div><div class="panel-footer"><li class="media"><div class="media-body"><a class="pull-left" href="#"><img class="media-object img-circle" src="/img/icons/default.png" height="60px" width="60px" style="margin-right: 10px"/></a><div class="media-body">' + data.reply +
            '<br/><small class="text-muted">' + 'admin' + ' | ' + data.updated_at + '</small></div></div></li></div></div></div></div>';
            $('#panel_message_unread_' + data.student_id).replaceWith(function() {
                return $(message).hide().fadeIn();
            });
        },
        error: function(data) {
            console.log('Error: ', data);
        }
    });
});

$('#btn-send-new-message').on("click", function(e) {
    e.preventDefault();

    console.log($('#student_id').val())
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        student_id: $('#student_id').val(),
        message: $('#message').val(),
    }

    var type = "PUT";
    var url = "./studentNewMessage";

    $.ajax({
        type: type,
        url: url,
        data: formData,
        dataType: 'json',
        success: function(data) {
            var message = '<ul id="student-message-list" class="media-list"><li class="media"><div class="media-body"><a class="pull-left" href="/student/' + data.student_id + '"><img class="media-object img-circle" src="' + data.student_image + '" height="60px" width="60px" style="margin-right: 10px"/></a><div class="media-body">' + data.message + '<br/><small class="text-muted">' + data.student_name + ' | ' + data.created_at + '</small></div></div></li></ul>';
            $('#student-message-list').replaceWith(function() {
                return $(message).hide().fadeIn();
            });
        },
        error: function(data) {
            console.log('Error: ', data);
        }
    });
    $('form')[0].reset();
});
