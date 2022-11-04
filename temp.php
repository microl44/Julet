// insert new movie form
echo "<h3>Add new movie </h3>";
echo "<form action='index.php' method='POST'>";

echo "<label for='addName'> Name</label>";
echo "<input type='string' name='addName' required/> <br/>";

echo "<label for='addGenre'> Genre </label>"
echo "<input type='string' name='addGenre' requred /> <br/>";

echo "<label for='addIMDB'> IMDB Grade </label>"
echo "<input type='string' name='addIMDB' requred /> <br/>";

echo "<label for='addjayornay'> Jay or Nay </label>"
echo "<input type='string' name='addjayornay' requred /> <br/>";

echo "<label for='addPickedBy'> Picked BY </label>"
echo "<input type='string' name='addPickedBy' requred /> <br/>";

echo "<label for='addParticipants'> Participants </label>"
echo "<input type='string' name='addParticipants' requred /> <br/>";

echo "<label for='addIs_major'>WheelType </label>";
echo "<select name='addIs_major'>";
echo "<option value='1'> Big Wheel </option>";
echo "<option value='0'> Small Wheel </option>";

echo "<input type='submit' value='add movie'/>";
echo "</form>";
// form end