const express = require('express');
const bodyParser = require('body-parser');
const MongoClient = require('mongodb').MongoClient;
var ObjectId = require('mongodb').ObjectID;
const app = express();
app.set('view engine', 'ejs');
app.use(express.static('public'));
app.use(bodyParser.json())

var db;
MongoClient.connect('mongodb://juanfg:a@ds031601.mlab.com:31601/final-bases', function(err, database) {
    if (err)
        return console.log(err);
    db = database;
    app.listen(8004, function()  {
        console.log('Listening on port 8004');
    });
});

app.use(bodyParser.urlencoded({extended: true}))

app.get('/fields', function(req, res)  {
    db.collection('fields').find().toArray(function(err, result)  {
        if (err)
            return console.log(err);
        res.render('fields.ejs', {fields: result});
    });
});

app.get('/fieldscreate', function(req, res) {
    res.render('fieldsCreate.ejs');
});

app.post('/fields', function(req, res) {
    db.collection('fields').save(req.body, function(err, result) {
        if (err)
            return console.log(err);
        console.log('saved to database');
        res.redirect('/fields');
    });
});

app.get('/fieldsupdate/:id', function(req, res) {
    db.collection('fields').find({_id: ObjectId(req.params.id)}).toArray(function(err, result) {
        if (err)
            return console.log(err);
        res.render('fieldsUpdate.ejs', {fields: result});
    });
});

app.post('/fieldsupdate/:id', function(req, res)  {
    db.collection('fields')
        .findOneAndUpdate({_id: ObjectId(req.params.id)}, {
            $set: {
                name: req.body.name,
                location: req.body.location
            }
        }, {
            sort: {_id: -1},
            upsert: true
        }, function(err, result)  {
            if (err) 
                return res.send(err)
            res.redirect('/fields');
        })
});

app.delete('/fields/:id', function(req, res)  {
    db.collection('fields').findOneAndDelete({_id: ObjectId(req.params.id)}, function(err, result)  {
        if (err) 
            return res.send(500, err);
    });
});
