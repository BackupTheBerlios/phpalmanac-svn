<!--

maxYear = 2010;
minYear = 2004;

displayMonth = 2;
displayYear  = 2005;

function mailto(domain, user) { 
    document.location.href = "mailto:" + user + "@" + domain; 
}


function PopupWindow(href, w, h, settings) {

    leftpos = (screen.width) ? (screen.width-w)/2 : 0;
    toppos = (screen.height) ? (screen.height-h)/2 : 0;
    settings = 'height='+h+',width='+w+',top='+toppos+',left='+leftpos+' '+settings;
    window.open(href, 'popupwindow', settings)

}

function toggleDatePicker(eltName) {

    // if it's already there, this will make it go away
    if (toggleVisible(eltName)) {
	newCalendar(eltName);
    }

}

function dateClick(year,month,day) {
    document.location.href = 'day.php?usernum=137405393&y=' + year + '&m=' + month + '&d=' + day;
}

//-->