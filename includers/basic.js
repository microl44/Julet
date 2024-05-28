function GetHost()
{
	return `localhost`;
}

var headerStatus = 'inactive';

function DeleteAllCookies() 
{
    const cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i];
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

function ExpandHeader()
{
	const header = document.getElementById("navbar");
	if(headerStatus == 'inactive')
	{
		for (var i = 70; i < 500; i++)
		{
			header.style.height = i + "px";
		}
		headerStatus = 'active';
	}
	else
	{
		header.style.height = "80px";
		headerStatus = 'inactive';
	}
}

console.log("basic.js loaded.");
