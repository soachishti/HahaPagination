<?php
include("pagination.php");
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<title></title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	</head>
	<body>
		<?php
			$totalData = 105;
			$dataPerPage = 10;
			$totalPagesToShow = 5;
			$GETpath = "pagsssse";
			$currentPage = isset($_GET[$GETpath]) ? $_GET[$GETpath] : 1 ;

			$pagi = new Pagination($totalData, $dataPerPage, $GETpath);

			$pagi->setPage($currentPage);
		?>
		<h2>Modern Navigation Example</h2>
		<?php
			$pagi->generateNaviModern($totalPagesToShow);
		?>
		<h2>Classic Navigation Example</h2>
		<?php
			$pagi->generateNaviClassic($totalPagesToShow);
		?>
		<h2>Data Per Page Limit (As per current page)</h2>
		<?php
			$dataLimit = $pagi->getDataLimit();
			print "<b>Start:</b> " . $dataLimit['start'] . "<br />";
			print "<b>End:</b> " . $dataLimit['end'] . "<br /><br />";
			print "<b>Example SQL Query:</b><br/ >";
			print "SELECT data FROM store LIMIT <b>" . $dataLimit['start'] . "</b>, <b>" . $dataLimit['end'] . "</b>";
		?>
	</body>
</html>