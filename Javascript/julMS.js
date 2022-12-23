function createChoiceWheel() {
  duration = 3;
  // Create the container for the choice wheel
  const container = document.createElement('div');
  container.classList.add('choice-wheel-container');

  // Create the choice wheel
  const wheel = document.createElement('div');
  wheel.classList.add('choice-wheel');
  wheel.style.animation = `spin ${duration}s linear`;
  wheel.style.animationPlayState = 'paused';

  // Create the choices for the choice wheel
  const choices = ['Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5'];
  choices.forEach((choice) => {
    const choiceElement = document.createElement('div');
    choiceElement.classList.add('choice-wheel-section');
    choiceElement.textContent = choice;
    wheel.appendChild(choiceElement);
  });
  var angle;
  // Create the spin button
  const spinButton = document.createElement('button');
  spinButton.textContent = 'Spin';
  spinButton.addEventListener('click', () => {
    // Calculate a random angle to rotate the wheel
    angle = Math.floor((Math.random() * (30000 - 15000) + 15000));
    // Apply the rotation to the wheel using a CSS transition
    wheel.style.transition = 'transform 3s cubic-bezier(0, -0.55, 0.265, 0)';
    wheel.style.transform = `rotate(${angle}deg)`;
    wheel.style.animationPlayState ='running';
  });

  // Append the choice wheel and spin button to the container
  container.appendChild(wheel);
  container.appendChild(spinButton);

  var element = document.querySelector('.choice-wheel');
  return container;
}

const jul = createChoiceWheel();
document.body.appendChild(jul);

const style2 = document.createElement('style');
style2.textContent = `
  .choice-wheel {
    margin-top: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background-color: #ddd;
    position: relative;
    transform-style: preserve-3d;
  }

  .choice-wheel-section {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    align-items: center;
    justify-content: left;
    transform-origin: center;
    transform: rotate(calc((360deg / 5) * var(--section-index)));
    writing-mode: vertical;
    text-align: center;
    margin: 0 25px;
  }

  .choice-wheel-section:last-of-type {
    border-right: none;
  }

  .choice-wheel-section:nth-of-type(1) {
    --section-index: 0;
  }

  .choice-wheel-section:nth-of-type(2) {
    --section-index: 1;
  }

  .choice-wheel-section:nth-of-type(3) {
    --section-index: 2;
  }

  .choice-wheel-section:nth-of-type(4) {
    --section-index: 3;
  }

  .choice-wheel-section:nth-of-type(5) {
    --section-index: 4;
  }
`;
document.head.appendChild(style2);

var container = document.getElementsByClassName('choice-wheel');
var rect = container[0].getBoundingClientRect();
console.log(rect.right);

var posX = 250;
var posY = 250;

drawLines(posX, posY, 3);

function drawLines(posX, posY, sections) {
  // Calculate the rotation angle for each line
  var angle = 360 / sections;
  
  // Draw the lines
  for (var i = 0; i < sections; i++) {
    var degree = angle * i;
    
    // Calculate the end position of the line
    var endX = Math.floor(posX + 50 * Math.cos(degree * Math.PI / 180));
    var endY = Math.floor(posY + 50 * Math.sin(degree * Math.PI / 180));
    
    // Create a div element to represent the line
    var line = document.createElement("div");
    line.classList.add("line");
    
    // Set the position and size of the line
    line.style.left = 0 + "px";  // Change the left position to posX
    line.style.top = 0 + "px";  // Change the top position to posY
    line.style.width = "3px";
    line.style.height = "250px";
    line.style.transform = "rotate(" + degree + "deg)";
    line.style.backgroundColor = "#000000";
    
    // Add the line to the choice-wheel element
    var choiceWheel = document.querySelector(".choice-wheel");
    choiceWheel.appendChild(line);
  }
}