<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>BKFK Voting</title>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/canvasjs.min.js"></script>
	<script>
	function castVote(ideaID, clickedID) {
        window.scrollTo(0, 0);
        var msgDiv = document.getElementById("dialogBox");
        document.getElementById("hdnideaid").value = ideaID;
        //alert(msgDiv);
        if (msgDiv != null) {
            msgDiv.parentNode.removeChild(msgDiv);
        }
        //create element
        var title = 'Voting Confirmation';
        var message = "You are voting for idea number " + ideaID + ". Are you sure?";
        var box = document.createElement('div');
        var titlebar = document.createElement('p');
        var messageBox = document.createElement('p');
        var okButton = document.createElement('button');
        var cancelButton = document.createElement('button');
        //give id to each element
        box.id = "dialogBox";
        titlebar.id = "titlebar";
        messageBox.id = "message";
        okButton.id = "okButton";
        cancelButton.id = "cancelButton";
        //attach message titlebar and message and text to ok button
        titlebar.innerHTML = title;
        messageBox.innerHTML = message;
        okButton.innerHTML = "Ok";
        cancelButton.innerHTML = "Cancel";
        //append first titlebar and then message
        box.appendChild(titlebar);
        box.appendChild(messageBox);
        box.appendChild(okButton);
        box.appendChild(cancelButton);
        //set position of dialog box

        var boxWidth = 325;
        var boxLeftPosition = window.outerWidth * 0.5 - boxWidth * 0.5;
        var topMargin = 150;

        box.style.position = "fixed";
        box.style.width = boxWidth + "px";
        box.style.left = boxLeftPosition + "px";
        box.style.top = topMargin + "px";
        box.style.visibility = "visible";
        box.style.border = "1px solid #999999";
        box.style.paddingBottom = "8px";
        box.style.backgroundColor = "#FFFFFF";
        box.style.zIndex = "999999";
        //set style for title bar
        titlebar.style.padding = "5px";
        titlebar.style.margin = "0";
        titlebar.style.fontWeight = "bolder";
        titlebar.style.backgroundColor = "#DDDDDD";

        //set style  for message 
        messageBox.style.margin = "15px 10px 5px 5px";
        messageBox.style.textAlign = "center";

        //set style for ok button 
        okButton.style.textAlign = "center";
        okButton.style.width = "55px";
        okButton.style.marginLeft = "95px";

        //set style for cancel Button
        cancelButton.style.TextAlign = "center";
        cancelButton.style.width = "55px";
        cancelButton.style.marginLeft = "10px";
        //attach box to the body
        document.body.appendChild(box);

        //attach onclick event for ok button
        okButton.onclick = function() {
            document.body.removeChild(document.getElementById('dialogBox'));
            resettime();
            
            //var lockVote=confirm("You are voting for idea number "+ideaID+". Are you sure?");
            //if (lockVote){
            voteincrease(ideaID);
            if (document.getElementById("div_result").style.display == "block") {
                document.getElementById(varimgid).src = varsrc2;
            }
            /*}
            else{
            document.getElementById(varimgid).src=varsrc1;
            }*/
        };
        cancelButton.onclick = function() {
            document.body.removeChild(document.getElementById('dialogBox'));
            return false;
        };

    }

    function viewdescription(varideaid, varpollsid) {
    	//window.location.href = 'report2.asp?pollsid=1&status=0';
    	//console.log(varpollsid+'&ideaid='+varideaid);
    	window.location.href = 'description.php?pollsid='+varpollsid+'&ideaid='+varideaid;
		
    }

	</script>
    <script>
        /*var time20;
        var ajax = new nepoAjax();
        var mywindow;
        var Voted = 0;
        var DispReport = new rumsanCharts("images/FCF_Column3D.swf", "chart1Id", "550", "400");*/
        function showVideo() {
            document.getElementById('ytplayer').style.display = 'block';
        }
        function voteincrease(varideaid) {
            resettime();
            ajax.setVar("varideaid", varideaid);
            ajax.setVar("varpollsid", document.getElementById("hdnpollsid").value);
            ajax.setVar("cmd", "inccount");
            ajax.requestFile = "lib/backpage.asp";
            ajax.onCompletion = postvoteincrease;
            ajax.onError = servererror;
            ajax.method = "GET"
            ajax.runAJAX();
        }
        function postvoteincrease() {
            var result = ajax.response.split("^^");
            var isthank = result[0].split(" ")[0];
            document.getElementById("div_tellfriends").style.display = "none";
            document.getElementById('div_description').style.display = "none";
            document.getElementById("div_result").style.display = "none";
            
            if (result[0].length != 0) {
                //viewresult();
                if (result[0] == "Only one vote is allowed per day.") {
                    if (result[1] != "11/18/2008") {
                        //alert(trim(result[0]));
                        goback();
                    } else {
                        document.getElementById("div_vote").style.display = "none";
                        document.getElementById("div_voteresult").style.display = "block";
                        document.getElementById("div_msg").innerHTML = result[0];
                        document.getElementById("div_msg").style.display = "block";
                    }
                } else {
                    if(isthank=="Thank")
                    {
                    //alert("checkthank");
                    //DispReport.setDataXML(result[2]);
                    //DispReport.render('div_result');
                        document.getElementById("div_result").style.display = "block";
                        var x = document.getElementById('img_' + document.getElementById("hdnideaid").value);
                        if (x != null) {

                            var tmp3 = x.src.split("/");
                            var tmp4 = tmp3[tmp3.length - 1].split(".");
                            var tmp5 = tmp4[0];
                            var tmp6 = tmp5 + "_mark.gif";
                            x.src = "images/voting_icons/" + tmp6;
                        }
                             
                    }
                    document.getElementById("div_vote").style.display = "none";
                    document.getElementById("div_voteresult").style.display = "block";
                    
                    document.getElementById("div_msg").innerHTML = result[0];
                    document.getElementById("div_msg").style.display = "block";

                    /*	
                    }*/
                    /*else
                    {
                    //alert("hello");
                    document.getElementById("div_vote").style.display="none";
                    document.getElementById("div_voteresult").style.display="block";
                    document.getElementById("div_msg").innerHTML=result[0];
                    document.getElementById("div_msg").style.display="block";
                    document.getElementById("div_msg").style.backgroundImage="url(images/alert.png) no-repeat";
                    }*/






                }
            } else if (result[0].length == 0) {
                document.getElementById("div_msg").style.display = "none";
            }

            ////callparentads();
        }
        function servererror() {
            alert(ajax.response);
        }

        function viewresult() {
            resettime();
            ajax.setVar("varpollsid", document.getElementById("hdnpollsid").value);
            ajax.setVar("cmd", "viewresult");
            ajax.requestFile = "lib/backpage.asp";
            ajax.onCompletion = postviewresult;
            ajax.onError = servererror;
            ajax.method = "GET"
            ajax.runAJAX();
        }
        function postviewresult() {
            //time20=setTimeout("parent.location.href='http://www.bkfk.com/Modules/Ideation/IdeationContest.aspx';",20000);
            var result = ajax.response;
            document.getElementById("div_msg").style.display = "none";
            document.getElementById("div_tellfriends").style.display = "none";
            document.getElementById("div_vote").style.display = "none";
            document.getElementById('div_description').style.display = "none";
            document.getElementById("div_voteresult").style.display = "block";

            document.getElementById("div_result").innerHTML = "";
            //DispReport.setDataXML(result);
            //DispReport.render('div_result');
            //document.getElementById("div_result").innerHTML = "<input type='button' class='goback' name='back' id='back' value='' onClick='goback();'><br/>"
            //+ document.getElementById("div_result").innerHTML;
            ////callparentads();
        }

        function voterclosedfucntion() {
            alert("Voting Has Been Closed!!!"); 
        }
        /*function castVote(ideaID, varsrc1, varsrc2, varimgid, topMargin) {
            var parent = document.getElementById('video_td');
            var ytpl = document.getElementById('ytplayer');
            
            
            var displayVideoPopup = document.getElementById('displayVideoPopup');
            if(displayVideoPopup){
            	ytpl.style.display = 'none';
            	parent.appendChild(ytpl);
                document.body.removeChild(displayVideoPopup);
            }
            window.scrollTo(0, 0);
            var msgDiv = document.getElementById("dialogBox");
            document.getElementById("hdnideaid").value = ideaID;
            //alert(msgDiv);
            if (msgDiv != null) {

                msgDiv.parentNode.removeChild(msgDiv);
            }
            //create element
            var title = 'Voting Confirmation';
            var message = "You are voting for idea number " + ideaID + ". Are you sure?";
            var box = document.createElement('div');
            var titlebar = document.createElement('p');
            var messageBox = document.createElement('p');
            var okButton = document.createElement('button');
            var cancelButton = document.createElement('button');
            //give id to each element
            box.id = "dialogBox";
            titlebar.id = "titlebar";
            messageBox.id = "message";
            okButton.id = "okButton";
            cancelButton.id = "cancelButton";
            //attach message titlebar and message and text to ok button
            titlebar.innerHTML = title;
            messageBox.innerHTML = message;
            okButton.innerHTML = "Ok";
            cancelButton.innerHTML = "Cancel";
            //append first titlebar and then message
            box.appendChild(titlebar);
            box.appendChild(messageBox);
            box.appendChild(okButton);
            box.appendChild(cancelButton);
            //set position of dialog box

            var boxWidth = 325;
            var boxLeftPosition = getWindowSize()[0] * 0.5 - boxWidth * 0.5;

            box.style.position = "fixed";
            box.style.width = boxWidth + "px";
            box.style.left = boxLeftPosition + "px";
            box.style.top = topMargin + "px";
            box.style.visibility = "visible";
            box.style.border = "1px solid #999999";
            box.style.paddingBottom = "8px";
            box.style.backgroundColor = "#FFFFFF";
            box.style.zIndex = "999999";
            //set style for title bar
            titlebar.style.padding = "5px";
            titlebar.style.margin = "0";
            titlebar.style.fontWeight = "bolder";
            titlebar.style.backgroundColor = "#DDDDDD";

            //set style  for message 
            messageBox.style.margin = "15px 10px 5px 5px";
            messageBox.style.textAlign = "center";

            //set style for ok button 
            okButton.style.textAlign = "center";
            okButton.style.width = "55px";
            okButton.style.marginLeft = "95px";

            //set style for cancel Button
            cancelButton.style.TextAlign = "center";
            cancelButton.style.width = "55px";
            cancelButton.style.marginLeft = "10px";
            //attach box to the body
            document.body.appendChild(box);

            //attach onclick event for ok button
            okButton.onclick = function() {
                document.body.removeChild(document.getElementById('dialogBox'));
                resettime();
                
                //var lockVote=confirm("You are voting for idea number "+ideaID+". Are you sure?");
                //if (lockVote){
                voteincrease(ideaID);
                if (document.getElementById("div_result").style.display == "block") {
                    document.getElementById(varimgid).src = varsrc2;
                }
                
            };
            cancelButton.onclick = function() {
                document.body.removeChild(document.getElementById('dialogBox'));
                return false;
            };

        }*/


        function ShowMessage(title, message) {
            window.scrollTo(0, 0);

            var box = document.createElement('div');
            var titlebar = document.createElement('p');
            var messageBox = document.createElement('p');
            var okButton = document.createElement('button');
            var cancelButton = document.createElement('button');
            //give id to each element
            box.id = "dialogBox";
            titlebar.id = "titlebar";
            messageBox.id = "message";
            okButton.id = "okButton";

            titlebar.innerHTML = title;
            messageBox.innerHTML = message;
            okButton.innerHTML = "Ok";

            //append first titlebar and then message
            box.appendChild(titlebar);
            box.appendChild(messageBox);
            box.appendChild(okButton);

            //set position of dialog box

            var boxWidth = 325;
            var boxLeftPosition = getWindowSize()[0] * 0.5 - boxWidth * 0.5;

            box.style.position = "fixed";
            box.style.width = boxWidth + "px";
            box.style.left = boxLeftPosition + "px";
            box.style.top = "100px";
            box.style.visibility = "visible";
            box.style.border = "1px solid #999999";
            box.style.paddingBottom = "8px";
            box.style.backgroundColor = "#FFFFFF";
            box.style.zIndex = "999999";
            //set style for title bar
            titlebar.style.padding = "5px";
            titlebar.style.margin = "0";
            titlebar.style.fontWeight = "bolder";
            titlebar.style.backgroundColor = "#DDDDDD";

            //set style  for message 
            messageBox.style.margin = "15px 10px 5px 5px";
            messageBox.style.textAlign = "center";

            //set style for ok button 
            okButton.style.textAlign = "center";
            okButton.style.width = "55px";
            okButton.style.marginLeft = "135px";


            //attach box to the body
            document.body.appendChild(box);

            //attach onclick event for ok button
            okButton.onclick = function() {
                document.body.removeChild(document.getElementById('dialogBox'));
                return false;
            };


        }

        function goback() {
            resettime();
            document.getElementById("div_tellfriends").style.display = "none";
            document.getElementById("div_vote").style.display = "block";
            document.getElementById("div_voteresult").style.display = "none";
            document.getElementById('div_description').style.display = "none";
            document.getElementById("div_result").style.display = "none";
            document.body.removeChild(document.getElementById('displayVideoPopup'));
//            var x = document.getElementsByTagName('img');
//            for (i = 0; i < x.length; i++) {
//                if (x[i].id.match("img_")) {
//                    var tmp3 = x[i].src.split("/");
//                    var tmp4 = tmp3[tmp3.length - 1].split(".");
//                    var tmp5 = tmp4[0].split("_");
//                    var tmp6 = tmp5[0] + ".gif";
//                    x[i].src = "images/voting_icons/" + tmp6;
//                }
//            }
            document.getElementById("hdnideaid").value = "0";
            var myPlayer = document.getElementById('ytplayer');
			myPlayer.stopVideo();
            
            //callparentads();
            
        }

        /*function viewdescription(varideaid, varpollsid) {
            resettime();
            ajax.setVar("varideaid", varideaid);
            ajax.setVar("varpollsid", varpollsid);
            ajax.setVar("cmd", "canddescribe");
            ajax.requestFile = "lib/backpage.asp";
            ajax.onCompletion = postviewdescription;
            ajax.onError = servererror;
            ajax.method = "GET"
            ajax.runAJAX();
        }*/
        function postviewdescription() {
            var result = ajax.response;
            document.getElementById("div_tellfriends").style.display = "none";
            document.getElementById('div_description').style.display = "block";
            document.getElementById("div_vote").style.display = "none";
            document.getElementById("div_voteresult").style.display = "none";
            document.getElementById("div_describe").innerHTML = result;
            //callparentads();
        }
        function tellfriends() {
            resettime();
            document.getElementById("div_tellfriends").style.display = "block";
            document.getElementById('div_description').style.display = "none";
            document.getElementById("div_vote").style.display = "none";
            document.getElementById("div_voteresult").style.display = "none";
            //callparentads();
        }
        function sendmail() {
            if (document.getElementById("txtname").value.length == 0) {
                //alert("Please enter your name.");
                ShowMessage('Send Mail Verification', 'Please enter your name.');
                document.getElementById("txtname").select();
                return false;
            } else if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("txtemail").value)) == false) {
                //alert("Invalid E-mail Address! Please re-enter.");
                ShowMessage('Send Mail Verification', 'Invalid E-mail Address! Please re-enter.');
                document.getElementById("txtemail").select();
                return false;
            } else {
                if (trim(document.getElementById("txtfriendemail").value).length != 0) {
                    var splitmails = trim(document.getElementById("txtfriendemail").value).split(",");
                    var friendmail = "";
                    for (var k = 0; k < splitmails.length; k++) {
                        if (splitmails[k].length != 0 && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(splitmails[k])) == false) {
                            //alert("\""+splitmails[k]+"\""+" Invalid E-mail Address! Please re-enter.");
                            ShowMessage('Send Mail Verification', '\'' + splitmails[k] + '\'' + ' Invalid E-mail Address! Please re-enter.');
                            document.getElementById("txtfriendemail").select();
                            return false;
                        } else if (trim(splitmails[k]).length != 0) {
                            friendmail += trim(splitmails[k]) + ",";
                        }
                    }
                } else if (trim(document.getElementById("txtfriendemail").value).length == 0) {
                    //alert("Invalid Friend's E-mail Address! Please re-enter.");
                    ShowMessage('Send Mail Verification', 'Invalid Friend\'s E-mail Address! Please re-enter.');
                    document.getElementById("txtfriendemail").select();
                    return false;
                }
            }
            ajax.setVar("varpollsid", document.getElementById("hdnpollsid").value);
            ajax.setVar("txtname", document.getElementById("txtname").value);
            ajax.setVar("txtemail", document.getElementById("txtemail").value);
            ajax.setVar("txtfriendemail", friendmail.substring(0, friendmail.length - 1));
            ajax.setVar("txtmessage", document.getElementById("txtmessage").value);
            ajax.setVar("cmd", "sendmail");
            ajax.requestFile = "lib/backpage.asp";
            ajax.onCompletion = postsendmail;
            ajax.onError = servererror;
            ajax.method = "GET"
            ajax.runAJAX();
        }
        function postsendmail() {
            var result = ajax.response;
            document.getElementById("frmsendmail").reset();
            document.getElementById("div_tellfriends").style.display = "none";
            document.getElementById('div_description').style.display = "none";
            document.getElementById("div_vote").style.display = "block";
            document.getElementById("div_voteresult").style.display = "none";
            //callparentads();
            //alert("Your message has been sent");
            ShowMessage('Send Mail Verification', 'Your message has been sent.');
        }

        function mypopup(varurl) {
            //mywindow = window.open (varurl,"mywindow","width=550,height=550",'toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no');
            //mywindow.moveTo(300,300);

            //create element
            document.getElementById('ytplayer').style.display = 'none';
            var box = document.createElement('div');
            var imgContainer = document.createElement('div');
            var img = document.createElement('img');
            var closeButton = document.createElement('div');
            var image = new Image();
            image.onLoad = function() {
              //  alert(image.width); 
            };

            image.src = varurl;


            //document.body.appendChild(image);
            //return;
            //give id to each element
            box.id = "displayImagePopup";
            imgContainer.id = "imageContainer";
            img.id = "imgDisplay";
            closeButton.id = "message";
            //give image location
            img.src = varurl;
            img.width = 800;
            //appends
            box.appendChild(closeButton);
            box.appendChild(imgContainer);

            imgContainer.appendChild(img);
            if (img.width > 800) {
                img.width = img.width - img.width * 1 / 4;
            }
            //set position of dialog box
            box.style.width = "800px";
            box.style.position = "fixed";
            box.style.top = "0px";
            box.style.visibility = "visible";
            box.style.border = "1px solid #999999";
            box.style.padding = "40px 10px 10px 10px";
            box.style.backgroundColor = "#FFFFFF";
            box.style.margin = "0 auto";
            box.style.zIndex = "99999";
            //set style for close box

            closeButton.style.height = "20px";
            closeButton.style.width = "20px";
            closeButton.style.textAlign = "center";
            closeButton.innerHTML = "X";
            closeButton.style.position = "absolute";
            closeButton.style.top = "5px";
            closeButton.style.right = "10px";
            closeButton.style.backgroundColor = "#EEEEEE";
            closeButton.style.cursor = "pointer";
            //attach box to the body
            document.body.appendChild(box);

            //add functionality to the close button
            closeButton.onclick = function() {
                document.body.removeChild(document.getElementById('displayImagePopup'));
                document.getElementById('ytplayer').style.display = 'block';
            };
        }

        function mypopup1(varurl) {
            //mywindow = window.open (varurl,"mywindow","width=550,height=550",'toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no');
            //mywindow.moveTo(300,300);

            //create element
            //document.getElementById('ytplayer').style.display = 'none';
            
            var parent = document.getElementById('video_td');
            var ytpl = document.getElementById('ytplayer');
            ytpl.style.display = 'none';
            parent.appendChild(ytpl);
            var displayVideoPopup = document.getElementById('displayVideoPopup');
            if(displayVideoPopup){
                document.body.removeChild(displayVideoPopup);
            }
            var box = document.createElement('div');
            var imgContainer = document.createElement('div');
            var img = document.createElement('img');
            var closeButton = document.createElement('div');
            var image = new Image();
            image.onLoad = function() {
                //  alert(image.width); 
            };

            image.src = varurl;


            //document.body.appendChild(image);
            //return;
            //give id to each element
            box.id = "displayImagePopup";
            imgContainer.id = "imageContainer";
            img.id = "imgDisplay";
            closeButton.id = "message";
            //give image location
            img.src = varurl;
            img.width = 800;
            //appends
            box.appendChild(closeButton);
            box.appendChild(imgContainer);

            imgContainer.appendChild(img);
            if (img.width > 800) {
                img.width = img.width - img.width * 1 / 4;
            }
            //set position of dialog box
            box.style.width = "800px";
            box.style.position = "fixed";
            box.style.top = "0px";
            box.style.visibility = "visible";
            box.style.border = "1px solid #999999";
            box.style.padding = "40px 10px 10px 10px";
            box.style.backgroundColor = "#FFFFFF";
            box.style.margin = "0 auto";
            box.style.zIndex = "99999";
            //set style for close box

            closeButton.style.height = "20px";
            closeButton.style.width = "20px";
            closeButton.style.textAlign = "center";
            closeButton.innerHTML = "X";
            closeButton.style.position = "absolute";
            closeButton.style.top = "5px";
            closeButton.style.right = "10px";
            closeButton.style.backgroundColor = "#EEEEEE";
            closeButton.style.cursor = "pointer";
            //attach box to the body
            document.body.appendChild(box);

            //add functionality to the close button
            closeButton.onclick = function() {
                document.body.removeChild(document.getElementById('displayImagePopup'));
                //document.getElementById('ytplayer').style.display = 'block';
            };
        }

        /*Video Pop Up*/
        function video_pop(){
            // alert();
             //create element
           // document.getElementById('ytplayer').style.display = 'block';
            var box = document.createElement('div');
            var videoCont = document.createElement('div');
            var video = document.createElement('ytplayer');
            var closeButton = document.createElement('div');
            var ytpl = document.getElementById('ytplayer');
            
            // var image = new Image();
            // image.onLoad = function() {
              //  alert(image.width); 
            // };

            // image.src = varurl;


            //document.body.appendChild(image);
            //return;
            //give id to each element
            box.id = "displayVideoPopup";
            videoCont.id = "videoContainer";
            // video.id = "videoDisplay";
            closeButton.id = "message";
            //give image location
            // video.src = varurl;
            // video.width = 800;
            //appends
            box.appendChild(closeButton);
            box.appendChild(videoCont);
            // videoCont.appendChild(ytpl);
            // box.appendChild(ytubueurl);
            videoCont.appendChild(video);
            ytpl.style.display = 'block';
            videoCont.appendChild(ytpl);

            /*if (video.width > 800) {
                video.width = video.width - video.width * 1 / 4;
            }*/
            //set position of dialog box
            box.style.width = "450px";
            box.style.height = "250px";
            box.style.position = "fixed";
            box.style.top = "0px";
            box.style.visibility = "visible";
            box.style.border = "1px solid #999999";
            box.style.padding = "40px 10px 10px 10px";
            box.style.backgroundColor = "#FFFFFF";
            box.style.margin = "0 auto";
            box.style.zIndex = "99999";
            //set style for close box

            closeButton.style.height = "20px";
            closeButton.style.width = "20px";
            closeButton.style.textAlign = "center";
            closeButton.innerHTML = "X";
            closeButton.style.position = "absolute";
            closeButton.style.top = "5px";
            closeButton.style.right = "10px";
            closeButton.style.backgroundColor = "#EEEEEE";
            closeButton.style.cursor = "pointer";
            //attach box to the body
            document.body.appendChild(box);

            //add functionality to the close button
            closeButton.onclick = function() {
                var parent = document.getElementById('video_td');
                var ytpl = document.getElementById('ytplayer');
                // ytpl.style.display = 'none';
                parent.appendChild(ytpl);
                document.body.removeChild(document.getElementById('displayVideoPopup'));
                document.getElementById('ytplayer').style.display = 'none';
            };
        }
        /*End Video pop Up*/

        function callparentads_remove() {
            var hdnval = document.getElementById("hdnpollsid").value;
            if (hdnval == "1") {
                parent.location.href = 'http://www.bkfk.com/Modules/Ideation/going_green_poll.aspx#' + Math.floor(Math.random() * 9999999999);
            }
            if (hdnval == "2") {
                parent.location.href = 'http://www.bkfk.com/Modules/Ideation/sports_evolution_poll.aspx#' + Math.floor(Math.random() * 9999999999);
            }
            if (hdnval == "3") {
                parent.location.href = 'http://www.bkfk.com/Modules/Ideation/signature_style_poll.aspx#' + Math.floor(Math.random() * 9999999999);
            }
            if (hdnval == "4") {
                parent.location.href = 'http://www.bkfk.com/Modules/Ideation/digital_arts_poll.aspx#' + Math.floor(Math.random() * 9999999999);
            }
            if (hdnval == "5") {
                parent.location.href = 'http://bkfk.com/Modules/Ideation/myob_vote.aspx#' + Math.floor(Math.random() * 9999999999);
            }
        }

        function trim(str, chars) {
            return ltrim(rtrim(str, chars), chars);
        }

        function ltrim(str, chars) {
            chars = chars || "\\s";
            return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
        }

        function rtrim(str, chars) {
            chars = chars || "\\s";
            return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
        }

        function resettime() {
            if (time20 != undefined) {
                clearTimeout(time20);
                time20 = null;
            }
        }
    </script>

</head>
<body>
    <div id="middle">
        <div class="mid_content">
        <?php
        	include 'lib/connection.php';
        ?>
        <?php 
        	$pollsid = $_GET['pollsid'];
 			if(isset($pollsid) && $pollsid <> ""){
        ?>
        		<input type="hidden" name="hdnpollsid" id="hdnpollsid" value="<?php echo $pollsid; ?>" />
        		<div id="div_vote">
        			<div id="content">
        				<?php 
		        		$strsql = 'SELECT pollsdetail,pollsimg FROM tblpollmaster where pollsid="'.$pollsid.'" and status = 1';
		        		$query = mysql_query($strsql);
		        		$result = mysql_fetch_object($query);
		        		?>
		        		<?php /* ?><img src="<?php echo $result->pollsimg; ?>" alt="headbanner" /><?php */ ?>
		        		<h1><?php echo $result->pollsdetail; ?></h1>
		        		<br />
		        		<table cellpadding="0" cellspacing="0" class="mainTable">
		        			<?php 
	      					$strsql = 'SELECT ideaid,idea_name,idea_username,user_age,idea_link,idea_img FROM tblideapoll where pollsid="'.$pollsid.'" and status=1 ORDER BY cast( ideaid as signed)';
	        				$query = mysql_query($strsql);
							$i = 0;        			
		        			while($row = mysql_fetch_object($query)){
		        				if($i%2 == 0){
		        					$trclass = "even";	
		        				}else{
		        					$trclass = "odd";	
		        				}
		        			?>
		        				<tr class="<?php echo $trclass; ?>">
		        					<td width="25" class="dot" valign="top">
		        						<div class="id">
		        							<?php echo $row->ideaid; ?>
		        						</div>
		        					</td>
		        					<td class="dot" valign="top">
		        						<div id="user">
		        							<?php echo $row->idea_username; ?>
		        						</div>
		        					</td>
		        					<td>
		        						<div class="idea_name">
		        							<?php echo $row->idea_name; ?>
		        						</div>
		        					</td>
		        					<td>
		        						<div class="linkBtn">
		        							<div class="linkBtn" style="cursor: pointer;" onclick="viewdescription('<?php echo $row->ideaid; ?>','<?php echo $pollsid; ?>');"><?php echo $row->idea_link; ?></div>
		        						</div>
		        					</td>
		        					<td>
		        						<div class="voteBtn">
		        							<button name="voteid_<?php echo $row->ideaid; ?>" id="voteid_<?php echo $row->ideaid; ?>" onclick="castVote('<?php echo $row->ideaid; ?>',this.id)">Vote Now</button>
		        						</div>
		        					</td>
		        				</tr>
		        			<?php
		        			$i++;
		        			}
		        			?>
		        		</table>
		        		<input type="hidden" id="hdnideaid" value="0">
        			</div>
        		</div>
        <?php
 			}
        ?>
         
            <!-- Div for PollsResult-->
            <div id="div_voteresult" style="display: none;">
                <%
				Response.Write(imgheader)	
                %>
                <div id="div_msg" class='msg' style="display: none;">
                </div>
                <span style="height: 20px;">&nbsp;</span><br />
                <input type="button" class="goback" name="backResult" id="Button1" value="" onclick="goback();" />&nbsp;&nbsp;
                <div id="div_result" style="height: 20px!important;">
                </div>
                <!--<input type="button" class="startidea" name="cmdCancel" id="cmdCancel" value="" onClick="parent.location.href='http://www.bkfk.com/Modules/Ideation/IdeationContest.aspx';">-->
            </div>
            <!--Div for Contestant's Description -->
            <div id="div_description" style="display: none;">
                <%
				Response.Write(imgheader)			
                %>
                <div id="div_describe">
                </div>
                <br />
                <input type="button" class="goback" name="back" id="backDesc" value="" onclick="goback();"
                    style="position: absolute; margin-top: -50px;" />
            </div>
            <!--Div for Tell Your Friends -->
            <div id="div_tellfriends" style="display: none;">
                <%
				Response.Write(imgheader)				
                %>
                <div id="div_email">
                    <form name="frmsendmail" id="frmsendmail">
                    <table class="datatables">
                        <col width="200px" />
                        <col width="392px" />
                        <tr>
                            <td colspan="2">
                                <h2>
                                    Tell your friends about your favorite idea and ask them to vote for it!</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Your name:
                            </td>
                            <td>
                                <input type="text" name="txtname" id="txtname" size="28" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Your email:
                            </td>
                            <td>
                                <input type="text" name="txtemail" id="txtemail" size="28" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email Addresses of your friends (separate by comma):
                            </td>
                            <td>
                                <input size="28" type="text" name="txtfriendemail" id="txtfriendemail">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Message:
                            </td>
                            <td>
                                <textarea id="txtmessage" rows="4" name="txtmessage"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input class="send" type="button" name="cmdSend" id="cmdSend" value="" onclick="sendmail();" />
                                <input type="button" class="cancel" name="cmdCancel" id="cmdCancel" value="" onclick="goback();" />
                                <input type="button" class="goback" name="back" id="backMail" value="" onclick="goback();" />
                            </td>
                        </tr>
                    </table>
                    <br />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clear">
    </div>
    <script src="js/iframeResizer.contentWindow.min.js"></script>
</body>
</html>
