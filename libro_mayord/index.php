<?php
require_once "stimulsoft/helper.php";
?>
<!DOCTYPE html>

<html>
<head>
	<title>Report.mrt - Viewer</title>
	<link rel="stylesheet" type="text/css" href="css/stimulsoft.viewer.office2013.whiteblue.css">
	<script type="text/javascript" src="scripts/stimulsoft.reports.js"></script>
	<script type="text/javascript" src="scripts/stimulsoft.viewer.js"></script>

	<?php
		$options = StiHelper::createOptions();
		$options->handler = "handler.php";
		$options->timeout = 30;
		StiHelper::initialize($options);
	?>
	<script type="text/javascript">
		var report = new Stimulsoft.Report.StiReport();
		report.loadFile("reports/Report.mrt");

		var options = new Stimulsoft.Viewer.StiViewerOptions();
		var viewer = new Stimulsoft.Viewer.StiViewer(options, "StiViewer", false);

		viewer.onBeginProcessData = function (args, callback) {
			<?php StiHelper::createHandler(); ?>
		}

		viewer.report = report;
		viewer.renderHtml("viewerContent");

        var userButton = viewer.jsObject.SmallButton("userButton", "Atrás", "emptyImage");
        //userButton.image.src = "https://www.stimulsoft.com/favicon.png";
        userButton.image.src = "../css/arrow.png";

        userButton.action = function () {
            window.history.back();

        }

        var toolbarTable = viewer.jsObject.controls.toolbar.firstChild.firstChild;
        var buttonsTable = toolbarTable.rows[0].firstChild.firstChild;
        var userButtonCell = buttonsTable.rows[0].insertCell(0);
        userButtonCell.className = "stiJsViewerClearAllStyles";
        userButtonCell.appendChild(userButton);
	</script>
</head>
<body>
	<div id="viewerContent"></div>
</body>
</html>