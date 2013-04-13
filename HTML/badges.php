#!/usr/local/bin/php
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
	</head>
    <?php 
    include 'functions.php';
    $badgeval = $_GET["badge"]; ?>
	<body class="badge-page">

    	<div class="container" style="width:990px;">
			<div id="header" style="float:left;">
				<div id="topbar">
                <br class="cbt"/>
				<br class="cbt"/>
				<div id="hlogo" style="float:left;margin:57px 12px 0 0;overflow:hidden;">
					<a href="/" style="display:block;width:200px">Stack Explorer</a>
				</div>
				<div id="hmenus" style="margin:57px 12px 0 0;overflow:hidden;">
                </div>
			</div>
            <div id="content" style="float:left;width:930px;">
	            <div itemscope="" itemtype="http://schema.org/Article">
            	    <div id="Badge-header">
            		<h1 itemprop="name" style="text-align:center;">
						<?php
                            echo $badgeval;
                        ?>
					</h1>
                    </div>
                    <div id="BadgeList" style="float:left;">
                    	<h4 >User List For Scholar Badge</h4>
                    	<ul style="list-style-type: none;">
                        	<?php 
                                GetTopUsersForBadges($badgeval,10);
                            ?> 
                        </ul>
                    </div>
                    <div id="sidebar" style="float:right;">
                        <h4 >Top Locations for Scholar Badge</h4>
                        <ul style="list-style-type: none;">
                            <?php 
                                GetTopLocationsForBadges($badgeval,10);
                            ?>
                        </ul>        
                    </div>
                </div>
		    </div>
		    <div class="footer">
            </div>
		</div>
	</body>
</html>