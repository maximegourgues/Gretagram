const express = require('express');
const jwt  = require('jsonwebtoken');

const app = express();

app.get('/api', (req, res)=> {
  res.json({
    message: 'Welcome to the API'
  });
});

app.listen(8000, () => console.log('server started on port 8000'));
