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

// io.on('connection', (socket) => {
//   socket.on('message', data =>{
//   	io.emit('receive-message', data);
//   });
// });

io.on('connection', (socket) => {

    socket.on('message', (data, ) =>{
        io.emit('receive-message', data);
    });
    socket.on('join', function(room) {
        console.log(room);
        socket.join(room);
    });
});

server.listen(5000, () => {
    console.log('listening on *:5000');
});