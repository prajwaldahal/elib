function datediff(value,rent,id)
{
    x=document.getElementById("tot");
    y=document.forms[0];
    url="http://localhost/elib/sucess.php?q=";
    url+=id;
    y[7].value=url;
    console.log(url);
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange=function()
    {
        if(this.readyState==4 && this.status==200){
            if(this.responseText== '-1'){
                x.innerHTML="Error: invalid date";
                x.style.color="red";
                y[9].disabled=true;
            }
            else{
                x.innerHTML="RS. "+this.responseText;
                x.style.color="black";
                y[0].value=this.responseText;
                y[1].value=this.responseText;
                y[9].disabled=false;
            }
        }
    }
    xhr.open("get","datediff.php?data="+value+
    "&rent="+rent+"&id="+id,"true");
    xhr.send();
}