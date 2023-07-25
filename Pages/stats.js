class Stat
{
	constructor(title, content)
	{
		this.title = title;
		this.content = content;
	}
}

var host = `localhost`;

var stats = Array();

function GetStats()
{
  //console.log("GetParticipants() Called.");
  stats = [];

  fetch(`http://${host}/api/stats.php?`)
  .then(response => response.json())
  .then(data =>
  {
    results = data;

    for (var i = 0; i < results['data'].length; i++)
    {
      var tempObject = JSON.parse(results['data'][i]);
      stats.push(new Stat(tempObject.title, tempObject.content));
    }

    console.log(stats);
  })
  .catch(error => 
  {
    console.log(error);
  })
}

GetStats();