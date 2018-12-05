var xhr = createRequest();
var timeout = null;
var count = 0;
var colours = ["#ff9966" , "#99ccff", "#66ff66", "#ff99ff"];
var logCols = document.getElementsByClassName("logMessage");
var timeCols = document.getElementsByClassName("timeStamp");
var loaders = document.getElementsByClassName("loader");

window.onload = function() {
    if (xhr){
        var laptopList = JSON.parse(document.getElementById("laptoplist").innerHTML);
        var url = "../scripts/getLogData.php?laptopList=" + JSON.stringify(laptopList);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200){
                var xhrResponse = JSON.parse(this.responseText);
                var messages = xhrResponse;
                var messageElements = document.getElementsByClassName("logMessage");
                var timestampElements = document.getElementsByClassName("timeStamp");
                for (i = 0; i < messageElements.length; i++){
                    if (messages[i] != null){
                        messageElements[i].innerHTML = messages[i][0];
                        timestampElements[i].innerHTML = "<a href=\"http://kiosk.aut.ac.nz/LockerBox/Drawers/Logs/" + laptopList[i] + "\"> " + messages[i][1] + "</a>";
                    }
                }
                console.log("Clearing interval");
                window.clearInterval(timeout);
                changeBGColour("inherit");
                loaders[0].style.visibility = "hidden";
                loaders[1].style.visibility = "hidden";
            }
        }
        xhr.open("GET", url, true);
        xhr.send(null);
        timeout = window.setInterval(changeColours, 500);
    }
}

function changeColours(){
    console.log("Changing colours. value of count = " + count);
    changeBGColour(colours[count]);
    count++;
    if (count == colours.length){
        count = 0;
    }
}

function changeBGColour(colour){
    for (i = 0; i < timeCols.length; i++){
        timeCols[i].style.backgroundColor = colour;
        logCols[i].style.backgroundColor = colour;
        if (i < 2){
            loaders[i].style.borderTop = "4px solid " + colour;    
        }
    }
}

function stopLoaders(){
    
}