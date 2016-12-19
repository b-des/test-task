
Number.prototype.toHHMMSS = function () {
    var seconds = Math.floor(this),
        hours = Math.floor(seconds / 3600);
    seconds -= hours * 3600;
    var minutes = Math.floor(seconds / 60);
    seconds -= minutes * 60;

    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    return hours + ':' + minutes + ':' + seconds;
};


function Timer(funct, delayMs, times) {
    if (times == undefined) {
        times = -1;
    }
    if (delayMs == undefined) {
        delayMs = 10;
    }

    this.funct = funct;
    var times = times;
    var timesCount = 0;
    var ticks = (delayMs / 10) | 0;
    var count = 0;
    Timer.instances.push(this);

    this.tick = function () {
        if (count >= ticks) {
            this.funct();
            count = 0;
            if (times > -1) {
                timesCount++;
                if (timesCount >= times) {
                    this.stop();
                }
            }
        }
        count++;
    };

    this.stop = function () {
        var index = Timer.instances.indexOf(this);
        if (index >= 0) {
            Timer.instances.splice(index, 1);
        }
    };
}

Timer.instances = [];
Timer.items = [];

Timer.ontick = function () {
    for (var i in Timer.instances) {
        Timer.instances[i].tick();
    }
};

window.setInterval(Timer.ontick, 10);

var refreshTimers = function (callback) {
    $('.time-left').each(function () {
        var index = Timer.items.indexOf($(this).data('time'));
        if ($(this).data('time') != '' && index < 0) {
            Timer.items.push($(this).data('time'));
            var elem = this;
            new Timer(function () {
                var that = elem;
                var seconds;
                var time = Math.round(+new Date() / 1000);
                var deadline = $(that).data('time');
                time = new Date(time * 1000);

                deadline = new Date(deadline * 1000);

                seconds = (deadline - time) / 1000;

                if (seconds >= 0) {

                    $(that).text(seconds.toHHMMSS());
                } else {
                    $(that).text(0);
                    this.stop();
                    callback();

                }
            }, 1000, -1);
        }

    });


};
+function ($) {

    $(document).ready(function () {

        RemoveUser = function (id) {
            $.ajax({
                type: "POST",
                url: "/users/DeleteUser",
                data: "id=" + id,
                success: function (msg) {
                    if (msg == 'ok') {
                        $('#user_' + id).hide();
                    }
                }
            });
        };


        DeleteOrder = function (id) {
            $.ajax({
                type: "POST",
                url: "/main/DeleteOrder",
                data: "id=" + id,
                success: function (msg) {
                    if (msg == 'ok') {
                        $('#order_' + id).hide();
                    }
                }
            });
        };

        $(document).on('click', '#RemoveUser', function () {
            var id = $(this).data('id');
            if (id == 1) {
                alert('Ви не можете видалити цього користувача');
                return false;
            }
            RemoveUser(id);
        });

        $(document).on('click', '#DeleteOrder', function () {
            var id = $(this).data('id');
            DeleteOrder(id);
        });


        var i = 1;
        $(document).on('click', '#addInput', function () {
            var parent = $(this).parent();
            $(parent).find('#addInput').remove();
            var html = ' <div class="form-group">' +
                '<label class="col-md-3 control-label" for="textinput">Назва страви</label>' +
                '<div class="col-md-4">' +
                '<input id="textinput" name="title[' + i + ']" type="text" placeholder="Назва страви" class="form-control input-md" required="">' +
                '</div>' +
                '<div class="col-md-2">' +
                '<input id="textinput" name="quantity[' + i + ']" type="number" placeholder="Кількість" class="form-control input-md" required="">' +
                '</div>' +
                '<a href="#" class="btn btn-info col-md-1" id="addInput">Ще страва</a>' +
                '</div>';
            $(parent).after(html);
            i++;
        });

        $('#edit-user').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var id = button.data('id');
            var login = button.data('login');
            var modal = $(this);
            modal.find('[name="login"]').val(login);
            modal.find('[name="name"]').val(name);
            modal.find('[name="id"]').val(id);
        })
    });
}(jQuery);