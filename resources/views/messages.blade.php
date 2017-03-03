@extends('layouts.template')
@section('link')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('main')
<div class="container">
    <h2>Messages</h2>
    <?php
    if (Auth::user()->role == App\User::ROLE_ADMIN) {
        for ($i = 0; $i < count($msgs); $i++) {
            $message = $msgs[$i];
            if ($message["reply"] == null) {
    ?>
        <div class="panel-group" id="panel_message_unread_<?php echo $message["student_id"] ?>">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-target="#message_unread_<?php echo $message["student_id"] ?>" style="cursor: pointer">
                    Unread - <?php echo $message["student_name"] ?>
                </div>
                <div id="message_unread_<?php echo $message["student_id"] ?>" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="media-list">
                            <li class="media">
                                <div class="media-body">
                                    <a class="pull-left" href="/student/<?php echo $message["student_id"] ?>">
                                        <img class="media-object img-circle" src="<?php echo $message["student_image"] ?>" height="60px" width="60px" style="margin-right: 10px"/>
                                    </a>
                                    <div class="media-body">
                                        <?php echo $message["message"] ?>
                                        <br/>
                                        <small class="text-muted"><?php echo $message["student_name"] ?> | <?php echo $message["created_at"] ?></small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <form id="admin-message-reply">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input id="student_id_<?php echo $message["student_id"] ?>" name="student_id" type="hidden" value="<?php echo $message["student_id"] ?>">
                                    <input id="reply_<?php echo $message["student_id"] ?>" name="reply" type="text" class="form-control" placeholder="Enter Message" required/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success btn-send-reply" type="button" value="<?php echo $message["student_id"] ?>">REPLY</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <?php
            } else {
            ?>
        <div class="panel-group" id="panel_message_read_<?php echo $message["student_id"] ?>">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-target="#message_read_<?php echo $message["student_id"] ?>" style="cursor: pointer">
                    Read - <?php echo $message["student_name"] ?>
                </div>
                <div id="message_read_<?php echo $message["student_id"] ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="media-list">
                            <li class="media">
                                <div class="media-body">
                                    <a class="pull-left" href="/student/<?php echo $message["student_id"] ?>">
                                        <img class="media-object img-circle" src="<?php echo $message["student_image"] ?>" height="60px" width="60px" style="margin-right: 10px"/>
                                    </a>
                                    <div class="media-body">
                                        <?php echo $message["message"] ?>
                                        <br/>
                                        <small class="text-muted"><?php echo $message["student_name"] ?> | <?php echo $message["created_at"] ?></small>
                                    </div>
                                </div>
                            </li>
                            <hr/>
                            <li class="media">
                                <div class="media-body">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle" src="/img/icons/default.png" height="60px" width="60px" style="margin-right: 10px"/>
                                    </a>
                                    <div class="media-body">
                                        <?php echo $message["reply"] ?>
                                        <br/>
                                        <small class="text-muted">admin | <?php echo $message["updated_at"] ?></small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
    } elseif (Auth::user()->role == App\User::ROLE_USER) {
        $student = App\Student::where('user_id', Auth::user()->id)->first();
        if (!$student) {
        ?>
        <div class="row" style="text-align: center">
            <h4>
                You are not a student (yet).
            </h4>
        </div>
        <?php
        } elseif (count($msgs) == 0) {
        ?>
        <div class="panel-group" id="panel_message_student_<?php echo $student->id ?>">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-target="#message_student_<?php echo $student->id ?>" style="cursor: pointer">
                    Your message
                </div>
                <div id="message_student_<?php echo $student->id ?>" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul id="student-message-list" class="media-list">
                            <li class="media">
                                <div class="media-body">
                                    <p style="text-align: center">
                                        No message
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form id="student-new-message">
            <div class="form-group">
                {{ csrf_field() }}
                <div class="input-group">
                    <input id="student_id" name="student_id" type="hidden" value="<?php echo $student->id ?>">
                    <input id="message" name="message" type="text" class="form-control" placeholder="Enter Message" required/>
                    <span class="input-group-btn">
                        <button id="btn-send-new-message" class="btn btn-info" type="button">SEND NEW MESSAGE</button>
                    </span>
                </div>
            </div>
        </form>
        <?php
        } else {
            $message = $msgs[0];
            $student_id = $student->id;
        ?>
        <div class="panel-group" id="panel_message_student_<?php echo $message["student_id"] ?>">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-target="#message_student_<?php echo $message["student_id"] ?>" style="cursor: pointer">
                    Your message
                </div>
                <div id="message_student_<?php echo $message["student_id"] ?>" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul id="student-message-list" class="media-list">
                            <li class="media">
                                <div class="media-body">
                                    <a class="pull-left" href="/student/<?php echo $message["student_id"] ?>">
                                        <img class="media-object img-circle" src="<?php echo $message["student_image"] ?>" height="60px" width="60px" style="margin-right: 10px"/>
                                    </a>
                                    <div class="media-body">
                                        <?php echo $message["message"] ?>
                                        <br/>
                                        <small class="text-muted"><?php echo $message["student_name"] ?> | <?php echo $message["created_at"] ?></small>
                                    </div>
                                </div>
                            </li>
                            <?php
                            if ($message["reply"] != null) {
                            ?>
                            <hr/>
                            <li class="media">
                                <div class="media-body">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle" src="/img/icons/default.png" height="60px" width="60px" style="margin-right: 10px"/>
                                    </a>
                                    <div class="media-body">
                                        <?php echo $message["reply"] ?>
                                        <br/>
                                        <small class="text-muted">admin | <?php echo $message["updated_at"] ?></small>
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form id="student-new-message">
            <div class="form-group">
                {{ csrf_field() }}
                <div class="input-group">
                    <input id="student_id" name="student_id" type="hidden" value="<?php echo $student->id ?>">
                    <input id="message" name="message" type="text" class="form-control" placeholder="Enter Message" required/>
                    <span class="input-group-btn">
                        <button id="btn-send-new-message" class="btn btn-info" type="button">SEND NEW MESSAGE</button>
                    </span>
                </div>
            </div>
        </form>
        <?php
        }
        ?>

    <?php
    }
    ?>
</div>
@stop
@section('script')
<script type="text/javascript" src="/js/messages.js"></script>
@stop
