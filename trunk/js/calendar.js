         // how reliable is this test?
         isIE = (document.all ? true : false);
	 isDOM = (document.getElementById ? true : false);

         // Initialize arrays.
         var months = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
	 "Aug", "Sep", "Oct", "Nov", "Dec");
         var daysInMonth = new Array(31, 28, 31, 30, 31, 30, 31, 31,
            30, 31, 30, 31);
	 var displayMonth = new Date().getMonth();
	 var displayYear = new Date().getFullYear();
	 var displayDivName;
	 var displayElement;

         function getDays(month, year) {
            // Test for leap year when February is selected.
            if (1 == month)
               return ((0 == year % 4) && (0 != (year % 100))) ||
                  (0 == year % 400) ? 29 : 28;
            else
               return daysInMonth[month];
         }

         function getToday() {
            // Generate today's date.
            this.now = new Date();
            this.year = this.now.getFullYear();
            this.month = this.now.getMonth();
            this.day = this.now.getDate();
         }

         // Start with a calendar for today.
         today = new getToday();

        function newCalendar(eltName,attachedElement) 
        {
        if (displayYear>maxYear) displayYear = maxYear;
        if (displayYear<minYear) displayYear = minYear;
        
        
	    if (attachedElement) {
	       if (displayDivName && displayDivName != eltName) hideElement(displayDivName);
	       displayElement = attachedElement;
	    }
	    
	    displayDivName = eltName;
            today = new getToday();
            var parseYear = parseInt(displayYear + '');
            var newCal = new Date(parseYear,displayMonth,1);
            var day = -1;
            var startDayOfWeek = newCal.getDay();
            if ((today.year == newCal.getFullYear()) &&
                  (today.month == newCal.getMonth()))
	    {
               day = today.day;
            }
            var intDaysInMonth =
               getDays(newCal.getMonth(), newCal.getFullYear());
            var daysGrid = makeDaysGrid(startDayOfWeek,day,intDaysInMonth,newCal,eltName)
	    if (isIE) {
	       var elt = document.all[eltName];
	       elt.innerHTML = daysGrid;
            } else if (isDOM) {
	       var elt = document.getElementById(eltName);
	       elt.innerHTML = daysGrid;
	    } else {
	       var elt = document.layers[eltName].document;
	       elt.open();
	       elt.write(daysGrid);
	       elt.close();
	    }
	 }

	 function incMonth(delta,eltName) {
	   displayMonth += delta;
	   if (displayMonth >= 12) {
	     displayMonth = 0;
	     incYear(1,eltName);
	   } else if (displayMonth <= -1) {
	     displayMonth = 11;
	     incYear(-1,eltName);
	   } else {
	     newCalendar(eltName);
	   }
	 }

	 function incYear(delta,eltName) {
	   displayYear = parseInt(displayYear + '') + delta;
	   newCalendar(eltName);
	 }

	 function makeDaysGrid(startDay,day,intDaysInMonth,newCal,eltName) {
	    var daysGrid;
	    var month = newCal.getMonth();
	    var year = newCal.getFullYear();
	    var isThisYear = (year == new Date().getFullYear());
	    var isThisMonth = (day > -1)
	    daysGrid = '<table class="popupCalendar" border=0 cellspacing=0 cellpadding=2><tr><th class="browseMonth" colspan="3">';
	    daysGrid += '<a class="pagerLink" href="javascript:incMonth(-1,\'' + eltName + '\')">&laquo; </a>';


	    if (isThisMonth) { daysGrid += '<span class="today">' + months[month] + '</span>'; }
	    else { daysGrid += months[month]; }

	    daysGrid += '<a class="pagerLink" href="javascript:incMonth(1,\'' + eltName + '\')"> &raquo;</a>';
	    daysGrid += '</th><th class="browseGap">&nbsp;</th><th class="browseYear" colspan="3">';
	    daysGrid += '<a class="pagerLink" href="javascript:incYear(-1,\'' + eltName + '\')">&laquo;</a> ';


	    if (isThisYear) { daysGrid += '<span class="today">' + year + '</span>'; }
	    else { daysGrid += ''+year; }

	    daysGrid += '<a class="pagerLink" href="javascript:incYear(1,\'' + eltName + '\')"> &raquo;</a></th></tr>';
	    daysGrid += '<tr class="dayNames"><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr>';
	    daysGrid += '<tr>';
	    var dayOfMonthOfFirstSunday = (7 - startDay + 1);
	    
	    for (var intWeek = 0; intWeek < 6; intWeek++) 
	    {
	        var dayOfMonth = 0;
       
			for (var intDay = 0; intDay < 7; intDay++) 
			{
		         dayOfMonth = (intWeek * 7) + intDay + dayOfMonthOfFirstSunday - 7;
	
				 if (dayOfMonth <= 0) 
				 {
			         daysGrid += '<td class="notcurrentmonth">&nbsp;</td>';
				 } 
				 else if (dayOfMonth <= intDaysInMonth) 
				 {
				   daysGrid += '<td ';
	   				if (day > 0 && day == dayOfMonth) daysGrid+='class="today"'; 
				   daysGrid += '><a href="javascript:setDay(';
				   daysGrid += dayOfMonth + ',\'' + eltName + '\')">';
				   var dayString = dayOfMonth + "</a></td>";
				   if (dayString.length == 6) dayString = '0' + dayString;
				   daysGrid += dayString;
				 }
				 else
				 {
				 	daysGrid += '<td class="notcurrentmonth">&nbsp;</td>';
				 }
			}
			daysGrid += "</tr><tr>";
	      
	    }
	 

	    return daysGrid + '</table>';
	 
	 }

	 function setDay(day,eltName) 
	 {
	   dateClick(displayYear,numpad(displayMonth + 1),numpad(day));
	   hideElement(eltName);
	 }