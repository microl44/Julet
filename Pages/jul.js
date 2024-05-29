function CreateWheel(initSections = 8, labels =["UNK", "UNK","UNK","UNK","UNK","UNK","UNK","UNK","UNK","UNK","UNK"])
{
  var height = 500;
  var width = 500;
  var centerX = width / 2;
  var centerY = height / 2;
  var radius = height / 2;
  var duration = 8;
  var sections = initSections;
  var angle = 0;

  console.log(labels);
  //7, 11 and 14 are magical numbers, no idea what's happening there.
  angle = (360 / sections);

  //Contains the position of every label. As they're calculated to be the in-between point of two lines, and IDK how to select lines when drawn, it's a sperate array.
  var labelCoordinate = [];

  //fetches the content DIV on which the canvas is attached.
  const content = document.querySelector('.content');

  //create wheel holder. Holds the wheel and the spin button/input box.
  const wheelHolder = document.createElement('div');
  wheelHolder.classList.add('wheelHolder');

  const winnerMark = document.createElement('div');
  winnerMark.classList.add('winnerMark');

  const canvas = document.createElement('canvas');
  canvas.classList.add('wheel500');
  canvas.setAttribute("width", width);
  canvas.setAttribute("height", height);

  const durationInput = document.createElement('input');
  durationInput.setAttribute('id', 'wheelDurationInput');
  durationInput.classList.add('wheelDuration');
  durationInput.style.textAlign = "center";
  durationInput.setAttribute("placeholder", "8");

  //context is just the thing you use. Deal with it. Sets the width of lines drawn to 3 (1 i very small). Later set to 5 when drawing the border.
  //Counter is currently not needed (debugging console prints), or could be used to run % 2 === 0 operations when setting background color on segments.
  var ctx = canvas.getContext("2d");
  ctx.lineWidth = 3;
  var counter = 1;

  //itterates up from 0, in intervalls equalling the angle variable, until it reaches 360, meaning it completed a full lap.
  //ctx.beginPath to begin drawing, ctx.moveTo to determine the first point, then lineTo for destination. Finally ctx.stroke to draw. Multiple lineTo can be chained.
  //also pushes the angle of each label in the "label" array
  //Warning, uses math.
  ctx.save();
  for (let i = 0; i < 360; i += angle)
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
    console.log("Start angle = " + String((counter * i)) + ". Finish angle = " + String(((counter * angle) + angle)));
    ctx.strokeStyle = "black";
    labelCoordinate.push(i - (angle / 2));
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
    if(labels != null && labels[i] != null && labels[i] != 'undefined')
    {
      if(labels[i].length >= 0)
      {
        ctx.font = 'bold 25px Arial';
        if(labels[i].length > 5)
        {
          ctx.font = 'bold 23px Arial';
          if(labels[i].length > 10)
          {
            ctx.font = 'bold 21px Arial';
            if(labels[i].length > 15)
            {
              ctx.font = 'bold 17px Arial';
            }
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
    //console.log("LabelCoordinate[i]: " + labelCoordinate[i]);
    //console.log(labelCoordinate[i] + " " + labels[i]);
    ctx.restore();
  }

  //creates the spin button DOM element.
  const spinButton = document.createElement('button');
  spinButton.setAttribute('id', 'JulSpinBtnID');
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
      rotation = rotation + 4;
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
  });

  //append both spin button and wheel canvas to the "content" div which is supposed to exist on every page. If attaching to body, the wheel will go under the navbar.
  wheelHolder.appendChild(canvas);
  wheelHolder.appendChild(spinButton);
  wheelHolder.appendChild(durationInput);
  wheelHolder.appendChild(winnerMark);

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

function AddInputDiv()
{
  const content = document.querySelector('.content');
  
  const inputDiv = document.createElement('div');
  inputDiv.classList.add('JulInputDiv');
  
  const inputRow = document.createElement('div');
  inputRow.classList.add('inputField');
  
  const inputBox = document.createElement('input');
  inputBox.classList.add("inputBox");
  
  const deleteRowBtn = document.createElement('button');
  deleteRowBtn.setAttribute("id", "JulDeleteBtnID");
  deleteRowBtn.classList.add("deleteRowBtn");
  deleteRowBtn.textContent = "Delete";
  deleteRowBtn.setAttribute("tabindex", "-1");

  const applyBtn = document.createElement('button');
  applyBtn.setAttribute("id", "JulApplyBtnID");
  applyBtn.classList.add('JulApplyBtn')
  applyBtn.classList.add('Fancy-Btn');

  applyBtnH = document.createElement('h4');
  applyBtnH.textContent = "Apply Changes";
  applyBtn.appendChild(applyBtnH);

  const addInputRowBtn = document.createElement('button');
  addInputRowBtn.setAttribute("id", "JulAddInputRowBtnID");
  addInputRowBtn.classList.add('addInputRowBtn');
  addInputRowBtn.classList.add('Fancy-Btn');
  
  addInputRowBtnH = document.createElement('h4');
  addInputRowBtnH.textContent = "ADD ROW";
  addInputRowBtn.appendChild(addInputRowBtnH);

  inputBoxesList = document.querySelectorAll('.inputBox');

  deleteRowBtn.addEventListener('click', () =>
  {
    inputRow.remove();
    applyBtn.click();
  });

  AddInputBoxEvents(inputBox, applyBtn, addInputRowBtn, deleteRowBtn);

  addInputRowBtn.addEventListener('click', () =>
  {
    var node = inputRow.cloneNode(true);
    node.querySelector('.inputBox').value = "";

    AddInputBoxEvents(node.querySelector('.inputBox'), applyBtn, addInputRowBtn, node.querySelector('.deleteRowBtn')); 

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

function AddInputBoxEvents(inputBox, applyBtn, addInputRowBtn, deleteRowBtn)
{
  inputBox.addEventListener("keydown", function(event)
  {
    let currentInputList = document.getElementsByClassName("inputBox");
    let index = GetIndexOfElement(currentInputList, document.activeElement);

    if(event.key === "Enter")
    {  
      applyBtn.click();
    }
    
    else if(event.key === "Tab")
    {
      if(document.activeElement  == currentInputList[currentInputList.length - 1])
      {
        addInputRowBtn.click();
        applyBtn.click();
      }
    }
    
    else if(event.key === "Escape")
    {
      if(currentInputList.length > 1)
      {
        deleteRowBtn.click();
        applyBtn.click();
        currentInputList[currentInputList.length - 1].focus();
      }
      else
      {
        currentInputList[0].value = "";
      }
    }

    else if(event.keyCode == 38)
    {
      if(currentInputList.length > 1)
      {
        currentInputList[index - 1].focus();
      }
    }

    else if(event.keyCode == 40)
    {
      if(document.activeElement == currentInputList[currentInputList.length - 1])
      {
        return;
      }
      currentInputList[index + 1].focus();
    }
  });
}

function GetIndexOfElement(array, element)
{
  for(var i = 0; i < array.length; i++)
  {
    if(array[i] == element)
    {
      return i;
    } 
  }
  return -1;
}

function GetElementsByTag(className)
{
  return document.getElementsByClassName(`${className}`);
}

function UpdateWheel()
{
  labels = [];
  let sections = document.querySelectorAll('.inputBox');
  for (var i = 0; i < sections.length; i++) 
  {
    var tempString;
    if(sections[i].value == "")
    {
      tempString = "";
    }
    else
    {
      tempString = sections[i].value;
      if(sections[i].value.length > 20)
      {
        tempString = sections[i].value.substring(0, 20);
        tempString = tempString.concat("", "...");
      }
    }
    labels[i] = tempString;
  }
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
  instructionDiv.textContent = "Tab = Create New Entry"
  content.appendChild(instructionDiv);
}

CreateWheel(8);
AddInputDiv();
PrintDescription();