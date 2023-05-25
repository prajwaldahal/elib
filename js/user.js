function changeui(value)
{
    x= window.frames[0];  
    if(value=="Available Book List")
        x.location="AvailableBookList.php";
    else if(value=="Book Rented")
        x.location="BookReportStdnt.php";	
    else
        window.open('sessionDestroy.php','_self');
}