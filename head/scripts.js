function search(arg) {
	var sid = escape(document.getElementById('search').value);
	var bid = escape(arg);
	if (window.XMLHttpRequest) {
		se=new XMLHttpRequest();
	}
	else {
		se=new ActiveXObject("Microsoft.XMLHTTP");
	}
	se.onreadystatechange = function() {
		if (se.readyState == 4 && se.status==200) {
			document.getElementById("note_place").innerHTML=se.responseText;
		}
	}
	se.open("GET","../util/search.php?sid="+sid+"&bid="+bid,true);
	se.send();
}

function empty() {
	var s = document.getElementById('search').value;
	if (s=="Search   ") {
		document.getElementById('search').value = "";
	}
	if (s=="") {
		document.getElementById('search').value = "Search   ";
	}
}

function toggledisplay(e,pid) {
		var s = document.getElementById(e+pid).style.display;
		if (s == "none") {
			document.getElementById(e+pid).style.display = "block";
		}
		if (s == "block") {
			document.getElementById(e+pid).style.display = "none";
		}
	}

function toggleweight(e) {
	
}

function openOverlay(arg) {
	document.getElementById('contentContainer').style.display = "block";
	document.getElementById('contentBox').style.display = "block";
	document.getElementById('holderBox').style.display = "block";
	document.getElementById('main').style.position = "relative";
	document.getElementById('main').style.right = "8px";
	document.body.style.overflow = "hidden";

	var sid = escape(arg);
	overlayRead(sid);
}
function boardDelete(arg) {
	var bid = escape(arg);
	if (window.XMLHttpRequest) {
		bd = new XMLHttpRequest();
	}
	else {	
		bd = new ActiveXObject("Microsoft.XMLHTTP");
	}	
	bd.onreadystatechange = function() {
		if (bd.readyState == 4 && bd.status == 200) {
			location.reload(true);
		}
	}
	bd.open("GET","util/delete/board.php?bid="+bid, true);
	bd.send();
}
function noteDelete(arg) {
	var nid = escape(arg);
	if (window.XMLHttpRequest) {
		nd = new XMLHttpRequest();
	}
	else {	
		nd = new ActiveXObject("Microsoft.XMLHTTP");
	}	
	nd.onreadystatechange = function() {
		if (nd.readyState == 4 && nd.status == 200) {
			location.reload(true);
		}
	}
	nd.open("GET","util/delete/note.php?nid="+nid, true);
	nd.send();

}
function overlayEdit(arg) {
	var sid = escape(arg);
	if (window.XMLHttpRequest) {
		gp=new XMLHttpRequest();
	}
	else {
		gp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	gp.onreadystatechange = function() {
		if (gp.readyState == 4 && gp.status==200) {
			document.getElementById("postStream").innerHTML=gp.responseText;
			document.getElementById('notecontent').focus();
		}
	}
	gp.open("GET","util/get/note_edit.php?sid="+sid,true);
	gp.send();
	document.getElementById('saver').style.display = "block";
	document.getElementById('editor').style.display = "none";

}
function overlayRead(arg) {
	var sid = escape(arg);
	if (window.XMLHttpRequest) {
		gp=new XMLHttpRequest();
	}
	else {
		gp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	gp.onreadystatechange = function() {
		if (gp.readyState == 4 && gp.status==200) {
			document.getElementById("postStream").innerHTML=gp.responseText;
		}
	}
	gp.open("GET","util/get/note.php?sid="+sid,true);
	gp.send();

	document.getElementById('editor').style.display = "block";
	document.getElementById('saver').style.display = "none";
	document.asd.whichNote.value = sid;
}
function overlayReadSave(arg) {
	var sid = escape(arg);
	var note = escape(document.getElementById('notecontent').value);
	if (window.XMLHttpRequest) {
		gp=new XMLHttpRequest();
	}
	else {
		gp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	gp.onreadystatechange = function() {
		if (gp.readyState == 4 && gp.status==200) {
			document.getElementById("postStream").innerHTML=gp.responseText;
		}
	}
	gp.open("GET","util/get/note_save.php?sid="+sid+"&note="+note,true);
	gp.send();

	document.getElementById('editor').style.display = "block";
	document.getElementById('saver').style.display = "none";
	document.getElementById('whichNote').value = sid;
}
function closeOverlay() {
	document.getElementById('contentContainer').style.display = "none";
	document.getElementById('contentBox').style.display = "none";
	document.getElementById('holderBox').style.display = "none";
	document.getElementById('main').style.position = "static";
	document.getElementById('main').style.right = "0";
	document.body.style.overflow = "scroll";
	document.getElementById('whichNote').value = "";

}
