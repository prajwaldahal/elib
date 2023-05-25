function changeui(value)
{
    x= window.frames[0];
    if(value=="Add Book")
        x.location="AddBook.php";
    else if(value=="Book report")
        x.location="BookReport.php";				
    else if(value=="User List")
        x.location="UserList.php";
    else if(value=="Logout")
        window.open('sessionDestroyAdmin.php','_self');
    else
        x.location="IssuedBookRecord.php";	
}