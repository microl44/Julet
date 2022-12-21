<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "includers/header.php"; ?>
<script>
  function showCards() {
    const cards = document.querySelectorAll('.card');
    const prevButton = document.querySelector('#prev-button');
    const nextButton = document.querySelector('#next-button');

    let currentCardIndex = 0;

    prevButton.addEventListener('click', () => {
      currentCardIndex = (currentCardIndex - 1 + cards.length) % cards.length;
      updateCard();
    });

    nextButton.addEventListener('click', () => {
      currentCardIndex = (currentCardIndex + 1) % cards.length;
      updateCard();
    });

    function updateCard() {
      cards.forEach((card) => card.classList.remove('active'));
      cards[currentCardIndex].classList.add('active');
    }

    updateCard();
  }
</script>

  <!-- other HTML content goes here -->
  <?php 
$cards = ["hello", "second", "reee"];
if(isset($_SESSION['username']) || isset($_SESSION['password']))
{
	?>
	<script type="text/javascript" src="Javascript/functions.js"></script>
	<div class='content'>
		<div id="card-container">
		  <?php
		    for ($i = 0; $i < count($cards); $i++) {
		      echo '<div class="card" id="card-' . $i . '">';
		      echo '  <div class="card-header">' . $cards[$i] . '</div>';
		      echo '  <div class="card-body">' . $cards[$i] . '</div>';
		      echo '</div>';
		    }
		  ?>
		</div>
	</div>
	<button id="prevBtn">Prev</button>
	<button id="nextBtn">Next</button>
<?php
	include_once("includers/footer.php");
}
else
{
	notLoggedIn();
}

?>
</body>