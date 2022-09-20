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

// app.get('/', (req, res) => {
//   res.send('<h1>Hello world</h1>');
// });

io.on('connection', (socket) => {
  console.log('a user connected');
  socket.on('message', data =>{
  	io.emit('receive-message', data);
    // console.log('Message: '+data);
  });
});

// io.on('connection', (socket) => {
//   socket.on('comment', (msg) => {
//     console.log('message: ' + msg);
//   });
// });

server.listen(4000, () => {
    console.log('listening on *:4000');
});