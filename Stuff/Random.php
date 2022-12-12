<script type="text/javascript" src="Javascript/functions.js"></script>
<?php
if (isset($_GET['imdb_link'])) {
    $imdbLink = $_GET['imdb_link'];
    $html = file_get_contents($imdbLink);
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $title = $xpath->query('//*[@data-testid="hero-title-block__title"]')->item(0);
    $grade = $xpath->query('//span[@class="sc-7ab21ed2-1 jGRxWM"]')->item(0);
    echo "The movie has a name of ".$title->nodeValue." and a grade of ".$grade->nodeValue;
}
?>
<div id="imdbScrape">
    <form action='Random.php' method='GET'>
        <input type="text" id="imdb-link-input" type='submit' name='imdb_link' placeholder="input IMDB link here"/>
        <button type='submit' text="Submit">SUBMIT</button>
    </form>
</div>