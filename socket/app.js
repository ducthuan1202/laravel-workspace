const app = require('express')();
const http = require('http').createServer(app);
const io = require('socket.io')(http);

const SOCKET_EVENTS = {
    CHANNEL_MESSAGE: 'channel_message',
    EMIT_ONE: 'emit_one',
    EMIT_ALL: 'emit_all',
    NEW_CONNECT: 'new_connect',
    GET_USER_ID: 'get_user_id',
};

const userIdConnected = [];

/**
 * Bussiness check user online trên hệ thống
 * 
 * - Khi user bật trình duyệt, socket trên server lắng nghe sự kiện `connection`.
 * - Khi sự kiện connection được kích hoạt, server emit 1 sự kiện `new_connect` về client vừa kết nối.
 * - Phía client sẽ gửi lên id của user vừa kết nối, Server đón nhận giá trị và lưu vào mảng dữ liệu.
 * - Sau đó, server gửi lại danh sách id những user đang online về cho client.
 * - Từ dữ liệu đó, client sẽ hiển thị trạng thái của user lên browser cho người dùng xem.
 */
io.on('connection', (socket) => {

    /**
     * Phát sự kiện kết nối
     */
    socket.emit(SOCKET_EVENTS.NEW_CONNECT, {        
        socketId: socket.id,
        issued: socket.handshake.issued,
    });

    /**
     * Lắng nghe sự kiện ngắt kết nối
     */
    socket.on('disconnect', () => {

        userIdConnected.forEach((item, index) => {
            let key = Object.keys(item)[0];
            if (key === socket.id) {
                userIdConnected.splice(index, 1);
            }
        });
        
        io.emit(SOCKET_EVENTS.GET_USER_ID, {
            data: userIdConnected
        });

    });

    /**
     * Lắng nghe sự kiện get_user_id
     */
    socket.on(SOCKET_EVENTS.GET_USER_ID, (msg) => {

        let obj = {};
        obj[socket.id] = msg.userId;
        userIdConnected.push(obj);

        io.emit(SOCKET_EVENTS.GET_USER_ID, {
            data: userIdConnected
        });
    });

});

http.listen(3000, () => console.log('listening on *:3000'));