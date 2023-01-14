class Movie{
  constructor(id, name, genre, rating, jayornay, picker, participants, type)
  {
    this.id = id;
    this.name = name;
    this.genre = genre;
    this.rating = rating
    this.jayornay = jayornay;
    this.picker = picker;
    this.participants = participants;
    this.type = type;
  }
}

function CreateWheel(initSections = 8, labels =["UNK", "UNK","UNK","UNK","UNK","UNK","UNK","UNK","UNK","UNK","UNK"])
{
  var height = 800;
  var width = 800;
  var centerX = width / 2;
  var centerY = height / 2;
  var radius = height / 2;
  var duration = 8;
  var sections = initSections;
  var angle = 0;

  //7, 11 and 14 are magical numbers and as such I need to fucking multiply by 10000 and then devide by 10000. Determines the angle diff between each line for even areas.
  angle = Math.floor((360 / sections) * 10000) / 10000;

  //Contains the position of every label. As they're calculated to be the in-between point of two lines, and IDK how to select lines when drawn, it's a sperate array.
  var labelCoordinate = [];

  //creates the DOM element that is the wheel and sets the styling on it. As it's a MS, all styling should be within this file.
  const content = document.querySelector('.content');

  const wheelHolder = document.createElement('div');
  wheelHolder.style.display = "grid";
  wheelHolder.classList.add('wheelHolder');
  wheelHolder.setAttribute("width", "50%");
  wheelHolder.setAttribute("height", "100%");
  wheelHolder.style.float = "left"; 
  wheelHolder.style.marginLeft = "40px";

  const canvas = document.createElement('canvas');
  canvas.classList.add('wheel');
  canvas.setAttribute("width", width);
  canvas.setAttribute("height", height);
  canvas.style.borderRadius = "50%";

  const durationInput = document.createElement('input');
  durationInput.classList.add('wheelDuration');
  durationInput.style.textAlign = "center";
  durationInput.setAttribute("placeholder", "Spin duration DEFAULT (8)");

  //context is just the thing you use. Deal with it. Sets the width of lines drawn to 3 (1 i very small). Later set to 5 when drawing the border.
  //Counter is currently not needed (debugging console prints), or could be used to run % 2 === 0 operations when setting background color on segments.
  var ctx = canvas.getContext("2d");
  ctx.lineWidth = 3;
  var counter = 0;

  //itterates up from 0, in intervalls equalling the angle variable, until it reaches 360, meaning it completed a full lap.
  //ctx.beginPath to begin drawing, ctx.moveTo to determine the first point, then lineTo for destination. Finally ctx.stroke to draw. Multiple lineTo can be chained.
  //also pushes the angle of each label in the "label" array
  //Warning, uses math.
  ctx.save();
  for (let i = angle; i <= 360; i += angle)
  {
    ctx.save();
    if(counter % 2 == 0)
    {
      ctx.fillStyle = "#fecd00";
    }
    else
    {
      ctx.fillStyle = "#004Bff";
    }
    ctx.strokeStyle = "black";
    labelCoordinate.push(i - (angle / 2));
    console.log("Angle " + counter + ": " + Math.floor(i));
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.lineTo(centerX + radius * Math.cos(i / 180 * Math.PI), centerY + radius * Math.sin(i / 180 * Math.PI));
    ctx.moveTo(centerX, centerY);
    radiostuffStart = i * (Math.PI / 180);
    radiostuffEnd = (2 * Math.PI) / sections;
    ctx.arc(radius, radius, radius, radiostuffStart, radiostuffStart + radiostuffEnd, false);
    ctx.lineTo(centerX, centerY);
    ctx.fill();
    ctx.stroke();
    counter += 1;
    ctx.restore();
  }
  //Context settings to prepare for writing labels.
  ctx.font = '28px Arial';
  ctx.textAlign = "left";
  ctx.textBaseline = 'middle';
  ctx.fillStyle = "black";

  //Context settings to draw circle, and draws circle. The ctx.arc function uses mathy math stuff to find outer area.
  //ctx.lineWidth = 5;
  //ctx.beginPath();
  //ctx.arc(250, 250, 250, 0, 2 * Math.PI);
  //ctx.stroke();

  //Calculate the point of where to put labels. Pretty much the same from the previous math stuff, except the "+ 200" prevents it from going all the way to the edge.
  for(let i = 0; i < labelCoordinate.length; i++)
  {
    ctx.save();
    //console.log(ctx);
    if(labels[i].length > 10)
    {
      //console.log(labels[i].length);
      ctx.font = 'bold 25 Arial';
      if(labels[i].length > 15)
      {
        ctx.font = 'bold 23px Arial';
        if(labels[i].length > 20)
        {
          ctx.font = 'bold 21px Arial';
          if(labels[i].length > 30)
          {
            ctx.font = 'bold 17px Arial';
          }
        }
      }
    }
    //ctx.rotate(labelCoordinate[i] * (Math.PI / 180));
    const x = centerX + 50 * Math.cos(labelCoordinate[i] / 180 * Math.PI);
    const y = centerY + 50 * Math.sin(labelCoordinate[i] / 180 * Math.PI);
    ctx.translate(x, y);
    ctx.rotate(labelCoordinate[i] * (Math.PI / 180));
    ctx.fillText(`${labels[i]}`, 0, 0);
    ctx.translate(-x, -y);
    ctx.font = '16px Arial';
    console.log("LabelCoordinate[i]: " + labelCoordinate[i]);
    console.log(labelCoordinate[i] + " " + labels[i]);
    ctx.restore();
  }

  //creates the spin button DOM element.
  const spinButton = document.createElement('button');
  spinButton.textContent = 'Spin';

  //WHY THE FUCK DOESN'T JAVASCRIPT NEED SEMICOLONS?????? adds eventlistener to the button.
  //Listener finds a random number of degrees between 4000 and 6360 and spins the wheel that much, over the duration variable in seconds.
  var rotation = 0;


  spinButton.addEventListener('click', () => 
  {
    console.log("button clicked");
    if(!isNaN(parseInt(durationInput.value)))
    {
      duration = durationInput.value;
      console.log("duration of: " + duration);
    }
    else
    {
      duration = 8;
      console.log("not a number used as duration. Default value of 8 is used.");
    }

    if(duration > 12 && duration <= 20)
    {
      rotation = rotation + Math.floor(12000 + (Math.random() * 360) + (Math.random() * 2000));
    }
    else if (duration > 20)
    {
      rotation = rotation + Math.floor(20000 + (Math.random() * 360) + (Math.random() * 2000));
    }
    else
    {
      rotation = rotation + Math.floor(4000 + (Math.random() * 360) + (Math.random() * 2000));
    }

    if(rotation % Math.floor(angle) === 0)
    {
      rotation = rotation + 2;
      console.log("that was a close one!");
    }
    console.log(rotation);
    console.log(angle / (rotation % 360));

    canvas.style.transition = `transform ${duration}s`;
    canvas.style.transform = `rotate(${rotation}deg)`;
    duration = 8;
  });

  durationInput.addEventListener("keypress", function(event)
  {
    if(event.key === "Enter")
    {
      spinButton.click();
    }
  });
  
  canvas.addEventListener('transitionend', () =>
  {
    var largest = labelCoordinate[0];
    for(var i = 0; i < labelCoordinate.length; i++)
    {
      if(largest < labelCoordinate[i])
      {
        largest = labelCoordinate[i];
      }
    }
    tempStuff = Array.from(labelCoordinate);
    curr = labelCoordinate[0]
    let closest = tempStuff.sort( (a, b) => Math.abs(((rotation + angle) % 360) - a) - Math.abs(((rotation + angle) % 360) - b) )[0];
    console.log(labelCoordinate);
    console.log(labels);
    console.log("raw angle: " + ((rotation + angle) % 360));
    console.log("closest: " + closest);
    console.log("index: " + labelCoordinate.indexOf(closest));
    console.log("label: " + labels[labelCoordinate.indexOf(closest)]);
  });

  console.log(canvas);

  //append both spin button and wheel canvas to the "content" div which is supposed to exist on every page. If attaching to body, the wheel will go under the navbar.
  wheelHolder.appendChild(canvas);
  wheelHolder.appendChild(spinButton);
  wheelHolder.appendChild(durationInput);

  if(document.querySelector('.JulInputDiv'))
  {
    let JulInputDiv = document.querySelector('.JulInputDiv');
    content.insertBefore(wheelHolder, JulInputDiv);
  }
  else
  {
    content.appendChild(wheelHolder);
  }
}

function AddWinnerMark(radius, padding)
{
  const content = document.querySelector('.content');
  const winnerMark = document.createElement('div');
  winnerMark.style.position = "absolute";
  winnerMark.style.marginTop = "-10px";
  winnerMark.style.marginLeft = `${radius + padding}px`;
  winnerMark.style.zIndex = "800";
  winnerMark.style.border = "1px black solid";
  winnerMark.style.borderLeft = "5px solid transparent";
  winnerMark.style.borderRight = "5px solid transparent";
  winnerMark.style.borderTop = "20px solid red";

  content.appendChild(winnerMark);
}

function AddInputDiv()
{
  const content = document.querySelector('.content');
  const inputDiv = document.createElement('div');
  inputDiv.classList.add('JulInputDiv');
  inputDiv.setAttribute("width", "50%");
  inputDiv.setAttribute("height", "100%");
  inputDiv.style.float = "left";
  inputDiv.style.border = "3px solid";
  inputDiv.style.padding = "20px";
  inputDiv.style.borderRadius = "20px";
  inputDiv.style.marginLeft = "100px";
  const inputRow = document.createElement('div');
  inputRow.classList.add('inputField');
  inputRow.style.width = "500px";
  inputRow.style.marginBottom = "5px";
  inputRow.style.marginTop = "5px";
  const inputBox = document.createElement('input');
  inputBox.classList.add("inputBox");
  inputBox.style.width = "80%";
  inputBox.style.height = "40px";
  inputBox.style.fontSize = "25px";
  inputBox.style.float = "left";
  inputBox.style.marginTop = "5px";
  const deleteRowBtn = document.createElement('button');
  deleteRowBtn.classList.add("deleteRowBtn");
  deleteRowBtn.style.height = "40px";
  deleteRowBtn.textContent = "Delete";
  deleteRowBtn.style.padding = "0px 20px 0px 20px";
  deleteRowBtn.style.float = "right";
  deleteRowBtn.setAttribute("tabindex", "-1");
  deleteRowBtn.style.marginTop = "5px";
  const applyBtn = document.createElement('button');
  applyBtn.classList.add('JulApplyBtn')
  applyBtn.textContent = "Apply Changes";
  applyBtn.style.padding = "20px 60px 20px 60px";
  applyBtn.style.textAlign = "center";
  applyBtn.style.float = "left";
  applyBtn.style.marginBottom = "20px";

  const addInputRowBtn = document.createElement('button');
  addInputRowBtn.textContent = "Add Row";
  addInputRowBtn.style.float = "right";
  addInputRowBtn.style.padding = "20px 100px 20px 100px";

  inputBoxesList = document.querySelectorAll('.inputBox');

  deleteRowBtn.addEventListener('click', () =>
  {
    inputRow.remove();
    applyBtn.click();
  });

  inputBox.addEventListener("keypress", function(event)
  {
    if(event.key === "Enter")
    {
      applyBtn.click();
    }
  });

  inputBox.addEventListener("keydown", function(event)
  {
    if(event.key === "Tab")
    {
      addInputRowBtn.click();
      applyBtn.click();
    }
    else if(event.key === "Escape")
    {
      deleteRowBtn.click();
      applyBtn.click();
    }
  });

  addInputRowBtn.addEventListener('click', () =>
  {
    var node = inputRow.cloneNode(true);
    node.querySelector('.inputBox').value = "";

    node.querySelector('.inputBox').addEventListener("keydown", function(event)
    {
      if(event.key === "Tab")
      {
        addInputRowBtn.click();
        applyBtn.click();
      }
      else if(event.key === "Escape")
      {
        node.querySelector('.deleteRowBtn').click();
        applyBtn.click();
      }
    });

    node.querySelector('.inputBox').addEventListener("keypress", function(event)
    {
      if(event.key === "Enter")
      {
        applyBtn.click();
      }
    });

    node.querySelector('.deleteRowBtn').addEventListener('click', () =>
    {
      node.remove();
      applyBtn.click();
    });

    inputDiv.appendChild(node);
    applyBtn.click();
  });

  applyBtn.addEventListener('click', () =>
  {
    UpdateWheel();
  });

  inputDiv.appendChild(applyBtn);
  inputDiv.appendChild(addInputRowBtn);
  inputRow.appendChild(inputBox);
  inputRow.appendChild(deleteRowBtn);
  inputDiv.appendChild(inputRow);

  content.appendChild(inputDiv);
}

function UpdateWheel()
{
  labels = [];
  let sections = document.querySelectorAll('.inputBox');
  for (var i = 0; i < sections.length; i++) 
  {
    if(sections[i].value == "")
    {
      labels[i] = "UNK";
    }
    else
    {
      labels[i] = sections[i].value;
    }
  }
  console.log(labels);
  const content = document.querySelector('.wheelHolder');
  content.remove();
  CreateWheel(sections.length, labels);
}

function PrintDescription()
{
  const content = document.querySelector('.content');
  const instructionDiv = document.createElement('div');
  instructionDiv.style.width = "20%";
  instructionDiv.style.float = "left";
  instructionDiv.style.marginLeft = "50px";
  instructionDiv.style.textAlign = "left";
  instructionDiv.textContent =
  "Here's how to use the Wheel. You start by typing something into the input box to the left." +
  "Then you can use the Add Row to create a new row and update the wheel. You can also press the Delete button to remove the box and update the wheel." + 
  "You can also use Tab to create a new row, and then select the next box. In the same way you can use the Escape button instead of the graphical Delete button to remove and update the wheel" +
  "Once you've determined all the inputs you will need, you can input a number into the input field under the wheel which determines how many seconds the wheel will spin for." +
  "To spin the wheel you can either press enter when selecting the spin-duration selection box, or you can click the spin button.";

  content.appendChild(instructionDiv);
}

//lmao if the full path URL contains "jul.php" run this code. Lmaooo this is shit but fuck it, it works.
if (window.location.pathname.includes("jul.php")) 
{ 
  var results;
  var movies = new Array();

  const params = new URLSearchParams();
  params.append('picker', 'Micke');
  params.append('order', 'decending');
  params.append('jayornay', 'Jay');
  params.append('participant', 'Gabbe');

  console.log(`http://localhost/julet/api/movies.php?${params}`);

  fetch(`http://localhost/julet/api/movies.php?${params}`)
  .then(response => response.json())
  .then(data => 
  {
    results = data;

    for (var i = 0; i < results['data'].length; i++) 
    {
      var tempObject = JSON.parse(results['data'][i]);

      movies.push(new Movie(tempObject.id, tempObject.name, tempObject.genre, tempObject.rating, 
        tempObject.jayornay, tempObject.picker, tempObject.participants, tempObject.type));
    }
    console.log(movies);
  });



  CreateWheel(8);
  AddWinnerMark(400, 40);
  AddInputDiv();
  PrintDescription();
}

console.log("IHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPT");