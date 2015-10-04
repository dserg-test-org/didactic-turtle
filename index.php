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
				colNames:['e_id','e_name', 'b_id', 'b_name', 'depth'],
				colModel:[
					{name:'e_id', index:'e_id', key: true, width:50},
					{name:'e_name', index:'e_name', width:100},
					{name:'b_id', index:'b_id', width:100},
					{name:'b_name', index:'b_name', width:100},
					{name:'depth', index:'depth', width:100}
				],
				pager: '#pager',
				sortname: 'e_id',
				viewrecords: true,
				sortorder: "asc",
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