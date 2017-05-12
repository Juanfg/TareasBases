const express = require('express');
const bodyParser = require('body-parser');
const MongoClient = require('mongodb').MongoClient;
const app = express();
app.set('view engine', 'ejs');
app.use(express.static('public'));
app.use(bodyParser.json())

var db;
MongoClient.connect('mongodb://juanfg:a@ds031601.mlab.com:31601/final-bases', (err, database) => {
    if (err)
        return console.log(err);
    db = database;
    app.listen(3000, () => {
        console.log('Listening on port 3000');
    });
});

app.use(bodyParser.urlencoded({extended: true}))

app.get('/fields', (req, res) => {
    db.collection('fields').find().toArray((err, result) => {
        if (err)
            return console.log(err);
        console.log(result);
        res.render('fields.ejs', {fields: result});
    });
});

app.post('/fields', (req, res) => {
    db.collection('fields').save(req.body, (err, result) => {
        if (err)
            return console.log(err);
        console.log('saved to database');
        res.redirect('/fields');
    });
});