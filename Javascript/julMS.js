function createWheel()
{
  //placeholder labels until proper labeling is implemented
  var options = ["Option 1", "Option 2", "Option 3", "Option 4", "Option 5", "Option 6", "Option 7", "Option 8", "Option 9", "Option 10", "Option 11"];

  var height = 500;
  var width = 500;
  var centerX = width / 2;
  var centerY = height / 2;
  var duration = 10;
  var sections = 5;
  var angle = 0;

  //7, 11 and 14 are magical numbers and as such I need to fucking multiply by 10000 and then devide by 10000. Determines the angle diff between each line for even areas.
  angle = Math.floor((360 / sections) * 10000) / 10000;

  //Contains the position of every label. As they're calculated to be the in-between point of two lines, and IDK how to select lines when drawn, it's a sperate array.
  var labels = [];

  //creates the DOM element that is the wheel and sets the styling on it. As it's a MS, all styling should be within this file.
  const content = document.querySelector('.content');
  const canvas = document.createElement('canvas');
  canvas.classList.add('wheel');
  canvas.setAttribute("width", width);
  canvas.setAttribute("height", height);
  canvas.style.borderRadius = "50%";

  //context is just the thing you use. Deal with it. Sets the width of lines drawn to 3 (1 i very small). Later set to 5 when drawing the border.
  //Counter is currently not needed (debugging console prints), or could be used to run % 2 === 0 operations when setting background color on segments.
  var ctx = canvas.getContext("2d");
  ctx.lineWidth = 3;
  var counter = 1;

  //itterates up from 0, in intervalls equalling the angle variable, until it reaches 360, meaning it completed a full lap.
  //ctx.beginPath to begin drawing, ctx.moveTo to determine the first point, then lineTo for destination. Finally ctx.stroke to draw. Multiple lineTo can be chained.
  //also pushes the angle of each label in the "label" array
  //Warning, uses math.
  for (let i = angle; i <= 360; i += angle)
  {
    labels.push(i + (angle / 2));
    console.log("Angle " + counter + ": " + Math.floor(i));
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.lineTo(centerX + 250 * Math.cos(i / 180 * Math.PI), centerY + 250 * Math.sin(i / 180 * Math.PI));
    ctx.stroke();
    counter += 1;
  }

  //Context settings to prepare for writing labels.
  ctx.font = '20px Arial';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';

  //Calculate the point of where to put labels. Pretty much unique from the previous math stuff, except the "+ 200" prevents it from going all the way to the edge.
  for(let i = 0; i < labels.length; i++)
  {

    const x = centerX + 200 * Math.cos(labels[i] / 180 * Math.PI);
    const y = centerY + 200 * Math.sin(labels[i] / 180 * Math.PI);

    ctx.fillText(`${options[i]}`, x, y);
  }

  //Context settings to draw circle, and draws circle. The ctx.arc function uses mathy math stuff to find outer area.
  ctx.lineWidth = 5;
  ctx.beginPath();
  ctx.arc(250, 250, 250, 0, 2 * Math.PI);
  ctx.stroke();

  //creates the spin button DOM element.
  const spinButton = document.createElement('button');
  spinButton.textContent = 'Spin';

  //WHY THE FUCK DOESN'T JAVASCRIPT NEED SEMICOLONS?????? adds eventlistener to the button.
  //Listener finds a random number of degrees between 4000 and 6360 and spins the wheel that much, over the duration variable in seconds.
  var rotation = 0
  spinButton.addEventListener('click', () => 
  {
    rotation = rotation + Math.floor(4000 + (Math.random() * 360) + (Math.random() * 2000));
    console.log(rotation);
    console.log(angle / (rotation % 360));

    canvas.style.transition = `transform ${duration}s`;
    canvas.style.transform = `rotate(${rotation}deg)`;
  });
  
  //append both spin button and wheel canvas to the "content" div which is supposed to exist on every page. If attaching to body, the wheel will go under the navbar.
  content.appendChild(canvas);
  content.appendChild(spinButton);
}

//lmao if the full path URL contains "jul.php" run this code. Lmaooo this is shit but fuck it, it works.
if (window.location.pathname.includes("jul.php")) 
{
  createWheel();
}

console.log("IHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPT");