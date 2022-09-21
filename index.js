const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = require('socket.io')(server, {
    cors: {
        origin: '*',
    }
});

io.on('connection', (socket) => {

    socket.on('message', (data, data2) =>{
        // io.emit('receive-message', data, data2);
        socket.to(data).emit('receive-message', data2);
    });
    socket.on('join', function(room) {
        socket.join(room);
        console.log('test test')
    });
});

server.listen(5000, () => {
    console.log('listening on *:5000');
});