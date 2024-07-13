<?php
class Movie
{
	private $conn;

	public $id;
	public $name;
	public $rating;
	public $description;
	public $cover_path;

	function __construct($db)
	{
		$conn = $db;
	}

	function __destruct()
	{
		
	}

	function Insert($url, $conn)
	{
		try
		{
			$count = 0;
			$savePath = 'C:/xampp/htdocs/Julet/Shared/Images/cover.png';

			$count = $this->ScrapeCoverArt($url, $savePath);
		    $html = file_get_contents($url);
		    $dom = new DOMDocument();
		    @$dom->loadHTML($html);
		    $xpath = new DOMXPath($dom);
		    $this->description = $xpath->query('//span[contains(@class, "sc-2eb29e65-0")]')->item(0)->nodeValue;
		    $this->name = $xpath->query('//span[contains(@class, "sc-afe43def-1")]')->item(0)->nodeValue;
		    $this->rating = $xpath->query('//span[contains(@class, "sc-bde20123-1")]')->item(0)->nodeValue;

		    if(isset(($xpath->query('//div[contains(@class, "sc-afe43def-3")]')->item(0)->nodeValue)))
		    {
		   		$this->name = substr($xpath->query('//div[contains(@class, "sc-afe43def-3")]')->item(0)->nodeValue, 16);
		    }

			$sql = "INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)";
			$sql = $sql . "VALUES(:addName,:addGenre,:addIMDB,:addjayornay,:addPickedBy,:addParticipants,:addIs_major);";

			$stmt = $conn->prepare($sql);
			$stmt->bindvalue(':addName',$this->name);
			$stmt->bindvalue(':addGenre',$this->genre);
			$stmt->bindvalue(':addIMDB',$this->rating);
			$stmt->bindvalue(':addjayornay',$this->jayornay);
			$stmt->bindvalue(':addPickedBy',$this->picker);
			$stmt->bindvalue(':addParticipants',$this->participants);
			$stmt->bindvalue(':addIs_major',$this->type);
		    $stmt->execute();
		    $stmt->closeCursor();

		    if(isset($this->description) && $this->description != "")
		    {
				$this->description = addcslashes($this->description, '"\'');
				$sql = "INSERT INTO movieDescription(movieID, cover_path, description)
				VALUES(".$count.", 'C:/xampp/htdocs/Julet/Shared/Images/cover".($count-1).".png', '".$this->description."' )";
				$conn->query($sql);
		    }
		}
		catch(PDOException $e)
		{
			echo json_encode($e->getMessage());
			die();
			return;
		}
	}

	function ScrapeCoverArt($url, $savePath) 
	{
		$count = 1;
		// create a variable to store the modified save path
		$modifiedSavePath = $savePath;
		// check if the file already exists
		while (file_exists($modifiedSavePath)) 
		{
		    // if the file exists, modify the save path to include the number
		    $modifiedSavePath = preg_replace('/\.png$/', $count . '.png', $savePath);
		    $count++;
		}
		// use cURL to send an HTTP request to the web page
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);

		if ($error) {
		    echo json_encode("Error: " . $error);
		    return;
		}

		// use DOMDocument to parse the HTML
		$dom = new DOMDocument();
		@$dom->loadHTML($html);

		// use DOMXPath to find the img tag with the class "ipc-image"
		$xpath = new DOMXPath($dom);
		$img = $xpath->query("//img[@srcset]")->item(0);
		if (!$img) {
		    echo "Error: Could not find image tag";
		    return;
		}

		// if the img tag was found, download the image file and save it as a .png on the server
		$imageUrl = $img->getAttribute('src');
		$imageData = file_get_contents($imageUrl);
		if (!$imageData) 
		{
		    echo "Error: Could not retrieve image data from " . $imageUrl;
		    return;
		}
		if (!file_put_contents($modifiedSavePath, $imageData)) 
		{
		    echo "Error: Could not save image data to " . $modifiedSavePath;
		    return;
		}

		return $count;
	}
}
?>