"use strict";

(function () {
    // ======== private vars ========
    var socket;
    ////////////////////////////////////////////////////////////////////////////
    var init = function () {

        socket = new WebSocket('ws://127.0.0.1:8889');

        socket.onopen = connectionOpen;
        socket.onmessage = messageReceived;
        //socket.onerror = errorOccurred;
        //socket.onopen = connectionClosed;
        refreshTimers();
    };

    $(document).on('click', ".StatusDone", function () {
        var id = $(this).data('id');
        var message = JSON.stringify({'action': 'ChangeOrderStatus', 'value': 'done', 'id': id});
        socket.send(message);
    });

    $(document).on('click', ".SetTime", function () {
        var id = $(this).data('id');

        var deadline = $(this).parent().find('.deadline').val();
        if(deadline != 0 && deadline != undefined){
            var time = Math.round(+new Date() / 1000);
            time = time + (deadline * 60);

            var message = JSON.stringify({'action': 'OrderSetTime', 'value': time, 'id': id});
            socket.send(message);
        }
    });

    function connectionOpen() {

        var message = JSON.stringify({'action': 'CheckForNewOrder', 'value': '', 'id': ''});
        socket.send(message);

    }

    function messageReceived(e) {

        try {
            var msg = JSON.parse(e.data);
        } catch (err) {
            msg = e;
        }
        switch (msg.action) {
            case 'ChangeOrderStatus':
                ChangeOrderStatus(msg.id);
                break;
            case 'OrderSetTime':
                OrderSetTime(msg.id, msg.value);

                break;
            case 'CheckForNewOrder':
                NewOrder(msg.value);
                break;
        }
    }

    function connectionClose() {
        socket.close();
    }

    function GetUserData(callback) {
        $.ajax({
            type: "POST",
            url: "/main/GetUserData",
            data: "",
            success: function (msg) {
                callback(msg);
            }
        });
    }

    function ChangeOrderStatus(id) {
        GetUserData(function (msg) {
            try {
                msg = JSON.parse(msg);
            } catch (err) {}
            if (msg.usertype == 'cook') {
                $('#order_' + id).remove();
            } else if (msg.usertype == 'waiter') {
                var button = '<a href="#" class="btn btn-danger btn-xs" title="Видалити" id="DeleteOrder"' +
                    'data-id="' + id + '">' +
                    '<i class="glyphicon  glyphicon-remove "></i>' +
                    '</a>';
                $('#order_' + id).find('.status').text('Готово');
                $('#order_' + id).find('.time-left').text('0');
                $('#order_' + id).find('.time-left').data('time', '');
                $('#order_' + id).find('.user-actions').html(button);
                $('#order_' + id).css('background', '#9ee7ba');

            }
        })

    }

    function OrderSetTime(id, value) {
        $('#order_' + id).find('.status').text('Готується');
        $('#order_' + id).find('.time-left').data('time', value);
        refreshTimers(function () {
            var message = JSON.stringify({'action': 'ChangeOrderStatus', 'value': 'done', 'id': id});
            socket.send(message);
        });


    }

    function NewOrder(data) {
        GetUserData(function (msg) {
            try {
                msg = JSON.parse(msg);
            } catch (err) {
                msg = data;
            }
            if (msg.usertype == 'cook') {
                $('#order-list').append(data);
            }
        });

    }


    return {
        ////////////////////////////////////////////////////////////////////////////
        // ---- onload event ----
        load: function () {
            window.addEventListener('load', function () {
                init();
            }, false);
        }
    }
})().load();