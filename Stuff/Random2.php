<?php

$url = "https://www.imdb.com/title/tt0137523/";
$html = file_get_contents($url);
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xPath = new DOMXPath($dom);
@$movieName = $xPath->query('//*[@id="title-overview-widget"]/div[2]/div[2]/div/div[2]/div[2]/h1')->item(0)->nodeValue;
@$movieRating = $xPath->query('//*[@id="title-overview-widget"]/div[2]/div[2]/div/div[2]/div[1]/div[1]/div[1]/strong')->item(0)->nodeValue;
echo "Movie Name: " . $movieName . "<br/>Movie Rating: " . $movieRating;

?>

<script>
  const url = "https://www.imdb.com/title/tt0137523/";
  fetch(url)
    .then(res => res.text())
    .then(html => {
      let parser = new DOMParser();
      let doc = parser.parseFromString(html, "text/html");
      let movieName = doc.querySelector("#title-overview-widget > div.vital > div.title_block > div > div.titleBar > div.title_wrapper > h1").innerText;
      let movieRating = doc.querySelector("#title-overview-widget > div.vital > div.title_block > div > div.ratings_wrapper > div.imdbRating > div.ratingValue > strong").innerText;
      console.log(`Movie Name: ${movieName} Movie Rating: ${movieRating}`);
    });
</script>

<div id="title-overview-widget">
  <div class="vital">
    <div class="title_block">
      <div>
        <div class="titleBar">
          <div class="title_wrapper">
            <h1>Fight Club</h1>
          </div>
        </div>
        <div class="ratings_wrapper">
          <div class="imdbRating">
            <div class="ratingValue">
              <strong>8.8</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>