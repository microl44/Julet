let socket = new WebSocket("ws://85.24.245.135:8765");

var inputElement = document.getElementById("chatInput");
var responseDiv = document.getElementById("chatDivResponse");

let cookies = document.cookie;
let sessionID = getCookie("PHPSESSID");
let username = getCookie("username");

let color = ["red", "blue", "green", "yellow", "purple"]

var randomColor = Math.floor(Math.random() * color.length);


function AddEventListener()
{
	inputElement.addEventListener("keypress", function(event)
	{
		if(event.key === "Enter")
		{
			event.preventDefault();
			document.getElementById("btnChatInput").click();
		}
	});
}

function SendMessage()
{
	message = [];
	message[0] =  sessionID;
	message[1] = username;
	message[2] =  inputElement.value;
	inputElement.value = "";

	messageJSON = JSON.stringify(message);
	console.log("message to send: " + messageJSON);
	socket.send(messageJSON);
}

function AddMessage(sender, message)
{
	console.log("AddMessage called with params: " + sender + " " + message);
	var newElement = document.createElement("div");
	newElement.innerText = sender + ": " + message;

	//newElement.style.float = 'left';
	//newElement.style.color = color[randomColor];
	newElement.style.bottom = '50%';
	newElement.style.width = '100%';
	newElement.style.fontSize = '20px';
	newElement.style.paddingLeft = '50px';
	newElement.style.marginTop = '5px';
	newElement.style.height = '10%';
	newElement.style.textAlign = "left";
	newElement.style.borderBottom = "1px solid";
	newElement.style.overflowX = "hidden";
	//newElement.style.backgroundColor = 'red';

	responseDiv.appendChild(newElement);
	newElement.scrollIntoView(false);
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function connectToServer()
{
	message = [];
	message[0] = "connect"
	message[1] = sessionID;
	message[2] = username;

	messageJSON = JSON.stringify(message);
	socket.send(messageJSON);
}

socket.onopen = function(e){
	connectToServer()
	console.log("Connection established");
}

socket.onmessage = function(e){
	data = JSON.parse(e.data)
	console.log(data)
	AddMessage(data[0], data[1]);
}

socket.onclose = function(e){
	console.log("connection lost");
}

socket.onerror = function(e){
	console.log("some error happened");
}

AddEventListener();