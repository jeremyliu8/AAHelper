<?php 

// course history from studentcourse
$coursehistory = "SELECT * FROM studentcourse where studentid='$stunum'";
$result = $connection->query($coursehistory);

while ($row = $result->fetch_array()) {
?> 
	<tr>
		<td> <?php echo $row['courseid']; ?> </td>
		<td> <?php echo $row['grade']; ?> </td> 
		<?php
			$termAndYear = $row['termtaken'];
			$yearTaken = substr($termAndYear, 0, 4);
			$termTaken = substr($termAndYear, 4);
		?>
		<td> 
			<?php if($termTaken == 1){
				echo "Spring";
			}
			elseif($termTaken == 4){
				echo "Summer";
			}
			elseif($termTaken == 7){
				echo "Fall";
			} ?> 
		</td>
		<td> <?php echo $yearTaken; ?> </td> 
	</tr> 
<?php
}
?>
