function setRedBorder(elemento){
    elemento.style = "border: 1px solid red";
}

function unsetBorder(elemento){
    elemento.style = "";
}

//controlli per i nomi delle squadre (non funzionante)
function controllaNomi(){
    var validi = true;
    var i = 0;
    while( i < frmNomiSquadre.numSquadre.value){
        if(document.getElementsByName("squadra" + (i+1)).value = ""){
            validi = false;
            setRedBorder(document.getElementsByName("squadra" + (i+1)));
        }
        else{
            unsetBorder(document.getElementsByName("squadra" + (i+1)));
            i++;
        }
        
    }
   
    return validi;
}