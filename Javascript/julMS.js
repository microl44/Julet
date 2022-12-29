function createWheel()
{
  var options = ["Option 1", "Option 2", "Option 3", "Option 4", "Option 5", "Option 6"]

  var height = 500;
  var width = 500;
  var centerX = width / 2;
  var centerY = height / 2;
  var duration = 10;
  var sections = 6;

  var angle = 360 / (sections - 1);
  var labels = [];

  const content = document.querySelector('.content');
  const canvas = document.createElement('canvas');
  canvas.classList.add('wheel');
  canvas.setAttribute("width", width);
  canvas.setAttribute("height", height);
  canvas.style.backgroundColor = "red";
  canvas.style.borderRadius = "50%";
  //canvas.style.backgroundColor = "white"

  var ctx = canvas.getContext("2d");
  for (let i = 0; i <= 360 ; i += angle)
  {
    labels.push(i + 30);
    console.log(i);
    ctx.beginPath();
    ctx.moveTo(centerX, centerY);
    ctx.lineTo(centerX + 250 * Math.cos(i / 180 * Math.PI), centerY + 250 * Math.sin(i / 180 * Math.PI));
    ctx.stroke();
  }

  ctx.font = '20px Arial';
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';

  for(let i = 0; i < labels.length - 1; i++)
  {
    // Calculate the position of the label
    const x = centerX + 200 * Math.cos(labels[i] / 180 * Math.PI);
    const y = centerY + 200 * Math.sin(labels[i] / 180 * Math.PI);
    // Draw the label on the canvas
    ctx.fillText(`${options[i]}`, x, y);
  }
  ctx.beginPath();
  ctx.arc(250, 250, 250, 0, 2 * Math.PI);
  ctx.stroke();

  const spinButton = document.createElement('button');
  spinButton.textContent = 'Spin';

  var rotation = 0;
  spinButton.addEventListener('click', () => 
  {
    canvas.style.transition = `transform 0s`;
    canvas.style.transform = `rotate(${-rotation}deg)`;

    rotation = rotation + Math.floor(2000 + (Math.random() * 360) + (Math.random() * 2000));

    // Apply the rotation to the wheel using a CSS transition
    canvas.style.transition = 'transform 8s';
    canvas.style.transform = `rotate(${rotation}deg)`;
  });
  
  content.appendChild(spinButton);
  return canvas;
}

const jul = createWheel();
document.body.appendChild(jul);