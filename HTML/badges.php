<?php 
    include 'functions.php';
    include 'urlHandler.php';

    $handler = new UrlHandler($_GET); 
    $badgeval = $handler->get_var("badge"); 
?> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>StackExplorer</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src=scripts/search.js></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

            // Load the Visualization API and the piechart package.
            google.load('visualization', '1.0', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = google.visualization.arrayToDataTable(<?php 
                   getDataArray($badgeval); ?>);

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.BarChart(document.getElementById('chart_div'))
                    .draw(data, {title:'Total Users earned the badge month wise',width: 500, height: 500});
            }
        </script>

<<<<<<< HEAD
    	<div class="container" style="width:990px;">
            <div id="content" style="float:left;width:930px;">
	            <div itemscope="" itemtype="http://schema.org/Article">
            	    <div id="Badge-header">
            		<h1 class="custom_h" style="text-align:center;">
						<?php
                            echo $badgeval;
                        ?>
					</h1>
                    </div>
                    <div id="BadgeList" style="float:left;">
                    	<?php print '<h4 class="custom_h">User List for \''.$badgeval.'\' Badge</h4>' ?>
                    	<ul class="list">
                        	<?php 
                                GetTopUsersForBadges($badgeval,10);
                            ?> 
                        </ul>
                    </div>
                    <div id="sidebar" style="float:right;">
                        <?php print '<h4 class="custom_h">Top Locations for \''.$badgeval.'\' Badge</h4>' ?>
                        <ul class="list">
=======
    </head>
    <body>
        <div id="wrapper">
    <?php 
        printLogo(); 
    ?>
    <div class="container" style="">
            <div id="Badge-header">
                <h1 itemprop="name" style="text-align:center;">
                    <?php
                        echo $badgeval;
                    ?>
                </h1>
            </div>
            <div id="content" style="">  
                <div id="BadgeList" style="float:left;width:70%">
                        <h3 >User List For Scholar Badge</h3>
                        <ul style="">
                            <?php 
                                GetTopUsersForBadges($badgeval,11);
                            ?> 
                        </ul>
                </div>
                <div id="sidebar" style="float:right;width:30%;">
                        <h3 style="text-align:center;">Top Locations for Scholar Badge</h3>
                        <ul style="">
>>>>>>> layout Changes and functionalitites
                            <?php 
                                GetTopLocationsForBadges($badgeval,11);
                            ?>
                        </ul>        
                </div> 
                <div id="chart_div" style="float:left;"></div>       
            </div>
    </div>
<?php                     
    printFooter();
?> 
