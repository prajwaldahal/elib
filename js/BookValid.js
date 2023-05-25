function showError(ind,Error)
{ 
    var x=document.forms[0];
    const newNode=document.createElement("p");
    textNode=document.createTextNode(x[ind].name+" "+Error);
    newNode.appendChild(textNode);
    x.insertBefore(newNode,x[ind]);
}
function validate()
{
    const strIndex=[];
    var i=0;
    var k = true;
    var x=document.forms[0];
    for (let index = 0; index < x.length-1; index++) {
        console.log(index+" "+x[index].name);
        if(index==5)
            continue;
        switch(x[index].value)
        {
            case"":
                strIndex[i]=index;
                i++;
                showError(index,"cannot be empty");
                k=false;
                break;
        }   
    }
    if(!strIndex.includes(0)){
        if(x[0].value.length<2){
            showError(0,"very short");
            k=false; 
        }
    }
    if(!strIndex.includes(2)){
        str=x[2].value;
        if(str.length<5){
            showError(2,"is very short");
            k=false;
        }
    }
    if(!strIndex.includes(1)){
        str=x[1].value;
        if(str.length<3){
            showError(1,"is very short");
            k=false;
        }
    }
    if(!strIndex.includes(3))
    {
        str=x[3].value;
        if(str.length==10||str.length==13)
        {
            result=/\d{13}/.test(str);
            result1=/\d{10}/.test(str);
            if(!(result || result1))
            {
                showError(3,"is invalid");
                k=false;
            }
            else
            {
                if(!(str.substring(0,3)=='978' || str.substring(0,3)=='979'))
                {
                    showError(3,'is invalid');
                    k=false;
                }
            }
        }     
        else
        {
            showError(3,"is invalid");
            k=false;
        }
    }

    if(!strIndex.includes(6))
    {
        str=x[6].value;
        if(str<20)
        {
            showError(6,"is invalid"); 
            k=false;
        }
    }

        return k;
} 
function removeText()
{
    var errorElement=document.getElementsByTagName("p");
    while(errorElement.length>0) {
        errorElement[0].remove();   
    }
}