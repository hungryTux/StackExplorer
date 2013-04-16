    <?php 

    include 'functions.php';
    include 'urlHandler.php';
    $handler = new UrlHandler($_GET);
    $locval = $handler->get_var("loc"); 

    //printHeader();

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
                   getLocArray($locval); ?>);

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.LineChart(document.getElementById('chart_div'))
                    .draw(data, {title:'Users joined from this location week wise',width: 500, height: 375});
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
        <?php 
            printLogo(); 
        ?>
	    <div class="container" style="">
            <div id="location-header">
                <h1 itemprop="name" style="text-align:center;">
                    <?php
                        echo $locval;
                    ?>
                </h1>
            </div>
            <div id="content" style="">  
                <div id="UserList" style="float:left;height:600px;width:65%;">
                        <div id="chart_div" style="height:375px;width:95%;border:1px solid #ABCBCC">
                        </div> 
                        <h4 style="text-align:center;">User List For Location</h4>  
                        <ul style="list-style-type: none; overflow:auto; height:200px; width:95%;border:1px solid #ABCBCC">
                            <?php 
                                    GetUsersForLoc($locval);
                            ?> 
                        </ul>
                </div>
                <div id="sidebar" style="float:right;height:600px;width:30%;">
                        <div id="topusers" style="">
                            <div id="newuser-box" style="">
                                <h4 style="text-align:center;">Top Users <br/>with accepted answers</h4>
                                <div>
                                    <ul style="">
                                       <?php
                                            GetTopAcceptedUsersForLoc($locval, 11);
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>    
                        <div id="topbadges" style="">
                            <div class="module newuser newuser-greeting" id="newuser-box" style="">
                                <h4 style="text-align:center;">Top badges for <?php echo $locval; ?></h4>
                                <div>
                                    <ul style="">
                                        <?php
                                            GetTopBadgesForLoc($locval, 11);
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                </div>
                <div id="Favourite Questions with Accepted Answers" style="float:left;width:100%;border:1px solid #ABCBCC">
                        <h3 style="text-align:center;">Favourite Answered Questions</h3>
                        <ul style="list-style-type: none;">
                            <?php 
                                GetFavQuestionsForLoc($locval,1,6);
                            ?>  
                        </ul>
                </div>
                <div id="Favourite Open Questions" style="float:left;width:100%;border:1px solid #ABCBCC">
                        <h3 style="text-align:center;">Favourite Open Questions</h3>
                        <ul style="list-style-type: none;">
                            <?php 
                                GetFavQuestionsForLoc($locval,0,6);
                            ?>  
                        </ul>
                </div>
            </div>
        </div>
<?php                     
    printFooter();
?> 