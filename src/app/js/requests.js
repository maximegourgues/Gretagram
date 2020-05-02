var phrasecode = 'fezj,gorohtehth8775aéà/[@rne'

function dbconnect(){
  var mysql = require('mysql')
  var connection = mysql.createConnection({
    host      : 'localhost',
    user      : 'root',
    password  : '',
    database  : 'gretabase'
  });

  connection.connect();
  return connection;
  console.log('connexion établie');

}


function insertuser(){
  var db = dbconnect()
  var id = arguments[0]
  var name = arguments[1]
  var password = arguments[2]

  let crypto = require ('crypto')
  const hash = crypto.createHmac('sha256',password).update(phrasecode).digest('hex');

  var data = [id,name,hash]

  db.query('INSERT INTO user SET id=?, name=?, password=?',data,(err,user,field)=>{
    if(err) throw err
    alert('Votre compte a bien été enregistré')
  })
}

function deleteuser(){
  var db = dbconnect()
  var data = [arguments[0]]
  db.query('DELETE FROM user WHERE id=?',data,(err,results,fields)=>{
    if(err)throw err;
  })
}

function updateuser(){
  var db = dbconnect()
  var data=["monmdp","user1"]
  db.query('UPDATE user SET mdp = ? WHERE id=?',data,(err,results,fields)=>{

  })
}

function getuser(){
  var db = dbconnect()
  var id = arguments[0]
  var password = arguments[1]

  let crypto = require ('crypto')
  const hash = crypto.createHmac('sha256',password).update(phrasecode).digest('hex');

  var data = [id,hash]

  db.query('SELECT * FROM user WHERE id =? AND password=?',data,(err,user,fields)=>{
    if(err) throw err ;
    if (user!=[])
      console.log(user)
    else {
      console.log('pas trouved')
    }
  })
}
