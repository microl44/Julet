var ws_uri = "ws://193.11.160.69:9600";
var websocket = new WebSocket(ws_uri, null, 5000, 10);

websocket.onopen = function(event)
{
	clearTimeout(null);
	MessageAdd("<div class='message green'>You have entered the chat room.</div>");
}

websocket.onclose = function(event)
{
	MessageAdd("<div class='message blue'>You have been disconnected.</div>");
}

websocket.onerror = function(event)
{
	MessageAdd("<div class='message red'>Connection to chat failed.</div>");
}

websocket.onmessage = function(event) 
{
	var message = JSON.parse(event.data);

	if(message.type == "message")
	{
		MessageAdd("<div class='message'>" + data.username + ": " + data.message + "</div>");
	}
}

document.getElementById("btnSend").addEventListener("submit", function(event)
{
	var message_element = document.getElementByTagName("input")[0];
	var message = message_element.value;

	if(message.toString().length > 0)
	{
		var data = {
			type: "message",
			username: username,
			message: message
		};

		console.log(data);
		websocket.send(JSON.stringify(data));
		message_element.value = "";
	}
});

document.getElementById("messageInput").addEventListener('keypress', function(event)
{
	if(event.key === 'Enter')
	{
		const message = event.target.value;
		MessageAdd(message);
	}
});

function Username()
{
	let x = document.sessionStorage;
	if(!x["username"])
	{
		var username = window.prompt("Enter your username:", "");

		if(username.toString().length > 3)
		{
			localStorage.setItem("username", username);
		}
		else
		{
			alert("Your username must be at least three characters.");
			Username();
		}
		document.cookie["username"] = username;
	}
	else
	{
		localStorage.setItem("username", x["username"]);
	}
}

Username();

function MessageAdd(message)
{
	var chat_messages = document.getElementById("chatMessages");

	chat_messages.insertAdjacentHTML("beforeend", message);
	chat_messages.scrollTop = chat_messages.scrollHeight;
}