

  function deleteCookie(cname) {
    var d = new Date(); //Create an date object
    d.setTime(d.getTime() - (1000*60*60*24)); //Set the time to the past. 1000 milliseonds = 1 second
    var expires = "expires=" + d.toGMTString(); //Compose the expirartion date
    window.document.cookie = cname+"="+"; "+expires;//Set the cookie with name and the expiration date

}

function deleteACookie(){
    var cname = window.document.getElementById('username').value;//Get the cookie name from the cname input element
    deleteCookie(cname);//Call the deleteCookie to delete the cookie
    window.location.reload();//Reload the page
}

function getCookie(cname) {
    var name = cname + "=";
    var cArr = window.document.cookie.split(';');
    for(var i=0; i<cArr.length; i++) {
        var c = cArr[i].trim();
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return "";
}
