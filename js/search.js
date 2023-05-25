function showSearch(cellno,formindex)
{
    x=document.forms[0];
    str=x[formindex].value.trim().toLowerCase();
    rowLen=document.getElementsByTagName("table")[0].rows.length;
    tr=document.getElementsByTagName("tr");
    for (let index = 1; index < rowLen; index++) {
        td=tr[index].getElementsByTagName("td")[cellno];
        firstvalue=td.textContent.toLowerCase().trim();
        if(firstvalue.startsWith(str))
            tr[index].style.display='table-row';
        else
            tr[index].style.display='none';
    }
}
