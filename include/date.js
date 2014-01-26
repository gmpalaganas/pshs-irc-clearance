/*
 * Countdown Timer for deadline
 * 
 * Developer: Genesis Ian M. Palaganas
 * 
 * This Javascript file has the function getTime() which
 * calculates the time difference between the current SERVER time
 * and the set deadline of the signing of clearance.
 * 
 * The time of differnce is in days,hours,minutes, and seconds
 * 
 */
function getTime()
{
var time;
var xmlhttp;

//To allow requests from the browser to the server
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
                time=xmlhttp.responseText;
		var today=new Date(time); //Set current SERVER time as current time
		var deadline=new Date("March 23, 2012 8:00:00"); //Set Deadline Here
		var diff =new Date();
		diff.setTime(deadline.getTime() - today.getTime()); //Get time difference
		var timediff = diff.getTime();
		
		var days = Math.floor(timediff / (1000 * 60 * 60 * 24)); 
		timediff -= days * (1000 * 60 * 60 * 24);

		var hours = Math.floor(timediff / (1000 * 60 * 60)); 
		timediff -= hours * (1000 * 60 * 60);
                
		
		var mins = Math.floor(timediff / (1000 * 60)); 
		timediff -= mins * (1000 * 60);
	
		var secs = Math.floor(timediff / 1000); 
		timediff -= secs * 1000;
                
                var day=(days==1)?"day":"days";
                var hour=(hours==1)?"hour":"hours";
                var min=(mins==1)?"minute":"minutes";
                var sec=(secs==1||secs==0)?"second":"seconds";
                
                if(days<0){ //If signing has ended
                    var res = "<center style='color:#fff799;'><b>Signing has Ended</b></center>";
                      document.getElementById('txt').innerHTML= res;
                }
                else{ //If signing is on going
                    
		var res = "<center style='color:#fff799;'><b>End of Signing in </b></center><b>" + days + "</b> "+ day +", <br/><b>" + hours + "</b> " + hour +" <br/><b>" + mins + "</b> " + min +", <br/><b>" + secs + " </b> " + sec;
		
		document.getElementById('txt').innerHTML= res;
		
		t=setTimeout('getTime()',1000);
                }
    }
  }
xmlhttp.open("GET","include/time.php",true); //Call PHP file to get the SERVER time for consitency
xmlhttp.send();
}