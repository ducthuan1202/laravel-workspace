const app = require('express')();
const http = require('http').createServer(app);
const io = require('socket.io')(http);

const SOCKET_EVENTS = {
    CHANNEL_MESSAGE: 'channel_message',
    EMIT_ONE: 'emit_one',
    EMIT_ALL: 'emit_all',
};



io.on('connection', (socket) => {

    socket.on(SOCKET_EVENTS.CHANNEL_MESSAGE, (msg) => {

        console.log(msg);

        socket.emit(SOCKET_EVENTS.CHANNEL_MESSAGE, { data: 'bay giờ là: ' + msg.time });

    });


    socket.on(SOCKET_EVENTS.EMIT_ONE, (msg) => {

        console.log(msg);

        socket.emit(SOCKET_EVENTS.EMIT_ONE, { data: 'Emit one: ' + msg.time });

    });


    socket.on(SOCKET_EVENTS.EMIT_ALL, (msg) => {

        console.log(msg);

        io.emit(SOCKET_EVENTS.EMIT_ALL, { data: 'Emit All: ' + msg.time });

    });

});


app.get('/socket',(req, res)=>{
    io.emit(SOCKET_EVENTS.EMIT_ALL, { data: 'Emit All by RESTful' });
    res.send(null);
});

http.listen(3000, () => console.log('listening on *:3000'));