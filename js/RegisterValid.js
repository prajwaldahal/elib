function   checkSymbol(text)
{
    text=text.split(" ");
    var result;
    if(text.length>1)
    {  
        for(i=0;i<text.length;i++)
        {
            result=/\W/g.test(text[i]); 
            if(result == true)
                return true;
        } 
    }
    else
        return /\W/g.test(text[0]);   
}
function   checkUpperCase(text)
{
    return /[A-Z]/g.test(text);   
}
function   checkLowerCase(text)
{
    return /[a-z]/g.test(text);   
}
function   checkDigit(text)
{
    return /\d/g.test(text);   
}
function   checkUnderscore(text)
{
    return text.includes('_');
}
function checkName(index)
{
    valid=true;
    x=document.forms[0];
    if(x[index].value.length>1)
    {
        if(checkSymbol(x[index].value) || checkDigit(x[index].value) || checkUnderscore(x[index].value))
        {
            showError(index,"should only contain letters");
            valid=false;
        }
    }
    else
    {
        showError(index,"is very short");
        valid=false;
    }
    return valid;
}
function showError(index,Error)
{ 
    var x=document.forms[0];
    const newNode=document.createElement("p");
    textNode=document.createTextNode(x[index].name+" "+Error);
    newNode.appendChild(textNode);
    x.insertBefore(newNode,x[index+1]);
}
function error()
{
    showError(7,"must contains at least one uppercase lowercase letter number and symbol ");
}
function validate()
{
    const strIndex=[];
    var i=0;
    var k = true;
    var x=document.forms[0];
    for (let index = 0; index < x.length-1; index++) {
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
    if(!strIndex.includes(0))
    {
        if(!checkName(0))
            k=false;
    }
    if(!strIndex.includes(1))
    {
        if(!checkName(1))
            k=false;
    }
    if(!strIndex.includes(2))
    {
       if(x[2].value.length>2)
       {
            if(checkSymbol(x[2].value))
            {
                showError(2,"cannot contain symbol");
                k=false; 
            }
       }
       else
       {
            showError(2,"is very short");
            k=false;
       }
    }
    if(!strIndex.includes(3))
    {
        if(x[3].value.length<6)
        {
            showError(6,"must be 6 character or more");
            k=false;
        }
    }
    if(!strIndex.includes(4)){
        str=x[4].value;
        if(str.length>8)
        {
            if(checkSymbol(str) || checkUnderscore(str)){
                if(checkDigit(str)){
                    if(checkLowerCase(str))
                    {
                        if (!checkUpperCase(str)) {
                           error();
                           k=false;
                        } 
                    } 
                    else{
                        error();
                        k=false;
                    }
                }
                else
                {
                    error();
                    k=false;
                }
            }
            else{
                error();
                k=false;
            }
        }
        else
        {
            error();
            k=false;
        }
    }
    return k;
}
function removeText()
{
    errorElement=document.getElementsByTagName("p");
    while(errorElement.length>0) {
        errorElement[0].remove();   
    }
}