var $addNewTask_xhr = null;
var $updateTask_xhr = null;
var $getTaskEditForm_xhr = null;
var $getTasks_xhr = null;
var $deleteTask_xhr = null;
var $addNewUser_xhr = null;
var $addNewUserGuest_xhr = null;
var $getUserEditForm_xhr = null;
var $updateUser_xhr = null;
var $deleteUser_xhr = null;
var $getSubTasks_xhr = null;
var $addNewSubTask_xhr = null;
var $getSubTaskEditForm_xhr = null;
var $updateSubTask_xhr = null;
var $tasks_url = '/tasks';

var clearForm = function ($form) {
    $('#' + $form + ' form input[type="text"]').each(function () {
        $(this).val('');
    });
    $('#' + $form + ' form input[type="checkbox"]').each(function () {
        $(this).prop('checked', false);
    });
    $('#' + $form + ' form input[type="radio"]').each(function () {
        $(this).prop('checked', false);
    });
    $('#' + $form + ' form textarea').each(function () {
        $(this).val('');
    });
    $('#' + $form + ' form select').each(function () {
        $(this)[0].selectedIndex = 0;
    });
}

var addNewTask = function ($btn) {
    if ($addNewTask_xhr === null) {
        $data = $('#add_new_task_form form input[type="text"], #add_new_task_form form input[type="hidden"], #add_new_task_form form input[type="checkbox"]:checked, #add_new_task_form form input[type="radio"]:checked, #add_new_task_form form textarea, #add_new_task_form form select');

        $addNewTask_xhr = $.ajax({
            url: '/task',
            type: 'POST',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Creating...');
            },
            complete: function () {
                $addNewTask_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Create');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#add_new_task_form').modal('hide');
                    clearForm('add_new_task_form');
                    getTasks($tasks_url);
                }
            },
            error: function ($addNewTask_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($addNewTask_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}

var getTaskEditForm = function ($id) {
    if ($getTaskEditForm_xhr === null) {
        $getTaskEditForm_xhr = $.ajax({
            url: '/task/' + $id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#update_task_form .modal-body').html('<div class="bar bar_color_grey bar_animate"></div>');
                $('#update_task_form .modal-footer').html('');
            },
            complete: function () {
                $getTaskEditForm_xhr = null;
            },
            success: function (json) {
                if (json.status == true) {
                    $('#update_task_form .modal-body').html(json.form);
                    $('#update_task_form .modal-footer').html('<button class="btn btn-update-task"><i class="fa fa-check"></i> Update</button>');
                }
            },
            error: function ($getTaskEditForm_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($getTaskEditForm_xhr.responseText);
                $('#update_task_form .modal-body').html($error.message);
            }
        });
    }
}

var changeTaskStatus = function ($row, $id, $status) {
    $changeTaskStatus_xhr = $.ajax({
        url: '/task/' + $id + '/' + $status,
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            if (json.status == true) {
                toastr.success(json.message);
                $row.replaceWith(json.task);
            }
        },
        error: function ($changeTaskStatus_xhr, ajaxOptions, thrownError) {
            $error = JSON.parse($changeTaskStatus_xhr.responseText);
            toastr.error($error.message);
        }
    });
}

var updateTask = function ($btn) {
    if ($updateTask_xhr === null) {
        $data = $('#update_task_form form input[type="text"], #update_task_form form input[type="hidden"], #update_task_form form input[type="checkbox"]:checked, #update_task_form form input[type="radio"]:checked, #update_task_form form textarea, #update_task_form form select');

        $updateTask_xhr = $.ajax({
            url: '/task',
            type: 'PUT',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating...');
            },
            complete: function () {
                $updateTask_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Update');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#update_task_form').modal('hide');
                    getTasks($tasks_url);
                }
            },
            error: function ($updateTask_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($updateTask_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}

var getTasks = function ($url) {
    if ($getTasks_xhr === null) {
        $taskContainer = $('div.task-list');

        $getTasks_xhr = $.ajax({
            url: $url,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $taskContainer.html('<div class="bar bar_color_blue bar_animate"></div>');
            },
            complete: function () {
                $getTasks_xhr = null;
            },
            success: function (json) {
                $taskContainer.html(json.tasks);
            },
            error: function ($getTasks_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($getTasks_xhr.responseText);
                $taskContainer.html($error.message);
            }
        });
    }
}

var deleteTask = function ($btn) {
    if ($deleteTask_xhr === null) {
        $data = $('#delete_task_form input[type="hidden"]');
        $deleteTask_xhr = $.ajax({
            url: '/task',
            type: 'POST',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Deleting...');
            },
            complete: function () {
                $deleteTask_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Delete');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#delete_task_form').modal('hide');
                    getTasks($tasks_url);
                }
            },
            error: function ($deleteTask_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($deleteTask_xhr.responseText);
                toastr.error($error.message);
            }
        });
    }
}

var addNewUser = function ($btn) {
    if ($addNewUser_xhr === null) {
        $data = $('#add_new_user_form form input[type="text"], #add_new_user_form form input[type="hidden"], #add_new_user_form form input[type="checkbox"]:checked, #add_new_user_form form input[type="radio"]:checked, #add_new_user_form form textarea, #add_new_user_form form select');
        $addNewUser_xhr = $.ajax({
            url: '/user',
            type: 'POST',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Creating...');
            },
            complete: function () {
                $addNewUser_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Create');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#add_new_user_form').modal('hide');
                    window.location.href = window.location.href;
                }
            },
            error: function ($addNewUser_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($addNewUser_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}


var addNewUserGuest = function ($btn) {
    if ($addNewUserGuest_xhr === null) {
        $data = $('#add_new_user_form_guest form input[type="text"], #add_new_user_form_guest form input[type="hidden"], #add_new_user_form_guest form input[type="checkbox"]:checked, #add_new_user_form_guest form input[type="radio"]:checked, #add_new_user_form_guest form textarea, #add_new_user_form_guest form select');
        $addNewUser_xhr = $.ajax({
            url: '/user',
            type: 'POST',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Creating...');
            },
            complete: function () {
                $addNewUser_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Create');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#add_new_user_form').modal('hide');
                    window.location.href = window.location.href;
                }
            },
            error: function ($addNewUser_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($addNewUser_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}

var deleteUser = function ($btn) {
    if ($deleteUser_xhr === null) {
        $data = $('#delete_user_form input[type="hidden"]');
        $deleteUser_xhr = $.ajax({
            url: '/user',
            type: 'POST',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Deleting...');
            },
            complete: function () {
                $deleteUser_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Delete');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#delete_user_form').modal('hide');
                    window.location.href = window.location.href;
                }
            },
            error: function ($deleteUser_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($deleteUser_xhr.responseText);
                toastr.error($error.message);
            }
        });
    }
}

var getUserEditForm = function ($id) {
    if ($getUserEditForm_xhr === null) {
        $getUserEditForm_xhr = $.ajax({
            url: '/user/' + $id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#update_user_form .modal-body').html('<div class="bar bar_color_grey bar_animate"></div>');
                $('#update_user_form .modal-footer').html('');
            },
            complete: function () {
                $getUserEditForm_xhr = null;
            },
            success: function (json) {
                if (json.status == true) {
                    $('#update_user_form .modal-body').html(json.form);
                    $('#update_user_form .modal-footer').html('<button class="btn btn-update-user"><i class="fa fa-check"></i> Update</button>');
                }
            },
            error: function ($getUserEditForm_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($getUserEditForm_xhr.responseText);
                $('#update_user_form .modal-body').html($error.message);
            }
        });
    }
}

var updateUser = function ($btn) {
    if ($updateUser_xhr === null) {
        $data = $('#update_user_form form input[type="text"], #update_user_form form input[type="hidden"], #update_user_form form input[type="checkbox"]:checked, #update_user_form form input[type="radio"]:checked, #update_user_form form textarea, #update_user_form form select');

        $updateUser_xhr = $.ajax({
            url: '/user',
            type: 'PUT',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating...');
            },
            complete: function () {
                $updateUser_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Update');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#update_user_form').modal('hide');
                    window.location.href = window.location.href;
                }
            },
            error: function ($updateUser_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($updateUser_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}

var getSubTasks = function ($id) {
    if ($getSubTasks_xhr === null) {
        $subtaskContainer = $('div.sub-task-wrapper .wrapper-body .sub-task-list');

        $getSubTasks_xhr = $.ajax({
            url: '/subtasks/' + $id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $subtaskContainer.html('<div class="bar bar_color_blue bar_animate"></div>');
            },
            complete: function () {
                $getSubTasks_xhr = null;
            },
            success: function (json) {
                $subtaskContainer.html(json.subtasks);
            },
            error: function ($getSubTasks_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($getSubTasks_xhr.responseText);
                $subtaskContainer.html($error.message);
            }
        });
    }
}

var addNewSubTask = function ($btn) {
    if ($addNewSubTask_xhr === null) {
        $data = $('#add_new_sub_task_form form input[type="text"], #add_new_sub_task_form form input[type="hidden"], #add_new_sub_task_form form input[type="checkbox"]:checked, #add_new_sub_task_form form input[type="radio"]:checked, #add_new_sub_task_form form textarea, #add_new_sub_task_form form select');

        $addNewSubTask_xhr = $.ajax({
            url: '/subtask',
            type: 'POST',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Creating...');
            },
            complete: function () {
                $addNewSubTask_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Create');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#add_new_sub_task_form').modal('hide');
                    clearForm('add_new_sub_task_form');
                    $('.sub-task-wrapper .wrapper-body .sub-task-list .col-sm-12').prepend(json.subtask);
                }
            },
            error: function ($addNewSubTask_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($addNewSubTask_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}

var getSubTaskEditForm = function ($id) {
    if ($getSubTaskEditForm_xhr === null) {
        $getSubTaskEditForm_xhr = $.ajax({
            url: '/subtask/' + $id,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#update_sub_task_form').modal('show');
                $('#update_sub_task_form .modal-body').html('<div class="bar bar_color_grey bar_animate"></div>');
                $('#update_sub_task_form .modal-footer').html('');
            },
            complete: function () {
                $getSubTaskEditForm_xhr = null;
            },
            success: function (json) {
                if (json.status == true) {
                    $('#update_sub_task_form .modal-body').html(json.form);
                    $('#update_sub_task_form .modal-footer').html('<button class="btn btn-update-sub-task"><i class="fa fa-check"></i> Update</button>');
                }
            },
            error: function ($getSubTaskEditForm_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($getSubTaskEditForm_xhr.responseText);
                $('#update_task_form .modal-body').html($error.message);
            }
        });
    }
}

var changeSubTaskStatus = function ($id, $status) {
    $changeSubTaskStatus_xhr = $.ajax({
        url: '/subtask/' + $id + '/' + $status,
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            if (json.status == true) {
                toastr.success(json.message);
                $('.subtask-' + $id).replaceWith(json.subtask);
            }
        },
        error: function ($changeSubTaskStatus_xhr, ajaxOptions, thrownError) {
            $error = JSON.parse($changeSubTaskStatus_xhr.responseText);
            toastr.error($error.message);
        }
    });
}

var updateSubTask = function ($btn) {
    if ($updateSubTask_xhr === null) {
        $data = $('#update_sub_task_form form input[type="text"], #update_sub_task_form form input[type="hidden"], #update_sub_task_form form input[type="checkbox"]:checked, #update_sub_task_form form input[type="radio"]:checked, #update_sub_task_form form textarea, #update_sub_task_form form select');

        $updateSubTask_xhr = $.ajax({
            url: '/subtask',
            type: 'PUT',
            data: $data,
            dataType: 'json',
            beforeSend: function () {
                $btn.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating...');
            },
            complete: function () {
                $updateSubTask_xhr = null;
                $btn.html('<i class="fa fa-check"></i> Update');
            },
            success: function (json) {
                if (json.status == true) {
                    toastr.success(json.message);
                    $('#update_sub_task_form').modal('hide');
                    $('.subtask-' + json.id).replaceWith(json.subtask);
                }
            },
            error: function ($updateSubTask_xhr, ajaxOptions, thrownError) {
                $error = JSON.parse($updateSubTask_xhr.responseText);
                $.each($error.errors, function ($i, $val) {
                    toastr.error($val);
                });
            }
        });
    }
}

var deleteSubTask = function ($id, $data) {
    $deleteSubTask_xhr = $.ajax({
        url: '/subtask',
        type: 'POST',
        data: $data,
        dataType: 'json',
        success: function (json) {
            if (json.status == true) {
                toastr.success(json.message);
                $('.subtask-' + $id).remove();
            }
        },
        error: function ($deleteSubTask_xhr, ajaxOptions, thrownError) {
            $error = JSON.parse($deleteSubTask_xhr.responseText);
            toastr.error($error.message);
        }
    });
}

$(document).ready(function () {
    toastr.options = {
        showEasing: 'swing',
        hideEasing: 'linear',
        timeOut: 1500,
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('button.btn-create-task').on('click', function () {
        addNewTask($(this));
    });
    $(document).on('click', 'a.task-status-action', function () {
        $this = $(this);
        $task_id = $this.attr('data-task-id');
        $status = $this.attr('data-status');
        $row = $this.closest('tr');
        changeTaskStatus($row, $task_id, $status);
    });
    $(document).on('click', 'a.task_edit', function () {
        $this = $(this);
        $task_id = $this.attr('data-task-id');
        getTaskEditForm($task_id);
    });
    $(document).on('click', 'button.btn-update-task', function () {
        updateTask($(this));
    });
    $(document).on('click', 'div.task-list table tfoot ul.pagination li a', function (e) {
        $tasks_url = $(this).attr('href');
        getTasks($tasks_url);
        e.preventDefault();
    });
    $(document).on('click', 'a.task_delete', function (e) {
        $task_id = $(this).attr('data-task-id');
        $('#delete_task_form input[name="id"]').val($task_id);
    });
    $(document).on('click', 'button.btn-delete-task', function (e) {
        $this = $(this);
        deleteTask($this);
    });
    $('button.btn-create-user').on('click', function () {
        addNewUser($(this));
    });

    $('button.btn-create-user-guest').on('click', function () {
        addNewUserGuest($(this));
    });

    $(document).on('click', 'a.user_edit', function () {
        $this = $(this);
        $user_id = $this.attr('data-user-id');
        getUserEditForm($user_id);
    });
    $(document).on('click', 'button.btn-update-user', function () {
        updateUser($(this));
    });
    $(document).on('click', 'a.user_delete', function (e) {
        $user_id = $(this).attr('data-user-id');
        $('#delete_user_form input[name="id"]').val($user_id);
    });
    $(document).on('click', 'button.btn-delete-user', function (e) {
        $this = $(this);
        deleteUser($this);
    });
    $(document).on('click', 'a.task_view', function () {
        $this = $(this);
        $task_id = $this.attr('data-task-id');
        $('body').addClass('scroll-lock');
        $('.sub-task-wrapper').addClass('show');
        $('.sub-task-wrapper .wrapper-footer').html('<a class="btn btn-add_new_sub_task_form pull-right" data-task-id="' + $task_id + '" href="#add_new_sub_task_form" role="button" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Create Sub Task</a>');
        getSubTasks($task_id);
    });
    $(document).on('click', '.sub-task-wrapper button.close', function () {
        $('.sub-task-wrapper').removeClass('show');
        $('body').removeClass('scroll-lock');
    });
    $(document).on('click', 'a.subtask-status-action', function () {
        $subtask_id = $(this).attr('data-sub-task-id');
        $status = $(this).attr('data-status');
        changeSubTaskStatus($subtask_id, $status);
    });
    $(document).on('click', 'a.subtask-edit', function () {
        $subtask_id = $(this).attr('data-sub-task-id');
        getSubTaskEditForm($subtask_id);
    });
    $(document).on('click', 'a.subtask-delete', function () {
        $subtask_id = $(this).attr('data-sub-task-id');
        $data = $(this).find('form input[type="hidden"]');
        deleteSubTask($subtask_id, $data);
    });
    $(document).on('click', 'a.btn-add_new_sub_task_form', function () {
        $task_id = $(this).attr('data-task-id');
        $('#add_new_sub_task_form form input[name="task_id"]').val($task_id);
    });
    $('button.btn-create-sub-task').on('click', function () {
        addNewSubTask($(this));
    });
    $(document).on('click', 'button.btn-update-sub-task', function () {
        updateSubTask($(this));
    });
});