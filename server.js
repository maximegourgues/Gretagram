
function dbconnect(){
  var mysql = require('mysql')
  var connection = mysql.createConnection({
    host      : 'localhost',
    user      : 'root',
    password  : '',
    database  : 'gretabase'
  });

  connection.connect();
  return connection
  console.log('connexion établie')

}

Insertuser();

function Insertuser(){
  var db = dbconnect()
  var password = "pwd2"
  var name = "username2"
  var id = "user2"

  let crypto = require ('crypto')
  const hash = crypto.createHmac('sha256',password).update('fezj,gorohtehth8775aéà/[@rne').digest('hex');

  var data = [id,name,password]
  db.query('INSERT INTO user SET id=?, name=?, password=?',data,(err,user,field)=>{
    if(err) throw err
  })
}
