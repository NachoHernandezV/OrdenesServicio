var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1;
var yyyy = hoy.getFullYear();
var fecha;

function setfecha()
 {
        if(dd<10) {
            dd='0'+dd;
        } 
        
        if(mm<10) {
            mm='0'+mm;
        } 
    fecha= yyyy+"-"+ mm + "-" + dd;
    return fecha;
 }



