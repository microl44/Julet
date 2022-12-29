function createWheel()
{
  var options = ["Option 1", "Option 2", "Option 3", "Option 4", "Option 5", "Option 6", "Option 7", "Option 8", "Option 9", "Option 10", "Option 11"];

  var height = 500;
  var width = 500;
  var centerX = width / 2;
  var centerY = height / 2;
  var duration = 10;
  var sections = 11;
  var angle = 0;

  //7, 11 and 14 are magical numbers and as such I need to fucking multiply by 10000 and then devide by 10000
  angle = Math.floor((360 / sections) * 10000) / 10000;

  var labels = [];

  const content = document.querySelector('.content');
  const canvas = document.createElement('canvas');
  canvas.classList.add('wheel');
  canvas.setAttribute("width", width);
  canvas.setAttribute("height", height);

  var ctx = canvas.getContext("2d");
  ctx.lineWidth = 3;
  var counter = 1;
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

  ctx.font = '20px Arial';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';

  for(let i = 0; i < labels.length; i++)
  {

    const x = centerX + 200 * Math.cos(labels[i] / 180 * Math.PI);
    const y = centerY + 200 * Math.sin(labels[i] / 180 * Math.PI);

    ctx.fillText(`${options[i]}`, x, y);
  }
  ctx.lineWidth = 5;
  ctx.beginPath();
  ctx.arc(250, 250, 250, 0, 2 * Math.PI);
  ctx.stroke();

  const spinButton = document.createElement('button');
  spinButton.textContent = 'Spin';

  //WHY THE FUCK DOESN'T JAVASCRIPT NEED SEMICOLONS??????
  var rotation = 0
  spinButton.addEventListener('click', () => 
  {
    rotation = rotation + Math.floor(4000 + (Math.random() * 360) + (Math.random() * 2000));
    console.log(rotation);
    console.log(angle / (rotation % 360));

    canvas.style.transition = 'transform 8s';
    canvas.style.transform = `rotate(${rotation}deg)`;
  });
  
  content.appendChild(spinButton);
  return canvas;
}

const jul = createWheel();
document.body.appendChild(jul);

console.log("IHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPTIHATEJAVASCRIPT");