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

//  Web Socket for MessageList
io.on('connection', (socket) => {
   
    socket.on('messagelist', (message) =>{
        io.emit('new-message', message);
    });
});

io.on('connection', (socket) => {

    socket.on('message', (roomID, message) =>{
        socket.to(roomID).emit('receive-message', message);
    });

    socket.on('join', function(roomID) {
        socket.join(roomID);
    });
});

server.listen(5000, () => {
    console.log('listening on *:5000');
});