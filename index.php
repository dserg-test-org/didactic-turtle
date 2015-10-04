<!doctype html>
<html>
<head>
	<script type = "text/javascript" src = "//code.jquery.com/jquery-2.1.4.min.js"></script>

	<link rel="stylesheet" type="text/css" media="screen" href="css/ui-lightness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />
	 
	<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>
	
	<link rel = "stylesheet" type = "text/css" href = "css/main.css">
	<script type = "text/javascript">
		$(document).ready(function() {
			$("#grid").jqGrid({
				url: "data.php",
				datatype: 'json',
				width: 700,
				height: 500,
				colNames:['Employee Name','Employee Boss', 'Distance from CEO'],
				colModel:[
					{name:'Employee Name', index: 'name', key: true},
					{name:'Employee Boss', sortable: false},
					{name:'Distance from CEO', sortable: false}
				],
				pager: '#pager',
				viewrecords: true,
				caption:"Org Chart Viewer"
			});
		});
	</script>
</head>
<body>
	<div id = "data"></div>
	
	<table id = "grid"></table>
	<div id="pager"></div>
</body>
</html>