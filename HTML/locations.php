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
    $locval = $_GET["loc"]; ?>
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
            	    <div id="location-header">
            		<h1 itemprop="name" style="text-align:center;">
						<?php
                            echo $locval;
                        ?>
					</h1>
                    </div>
                    <div id="BadgeList" style="float:left;">
                    	<h4 style="text-align:center;">User List For Location</h4>
                    	<ul style="list-style-type: none;">
                           <ul style="list-style-type: none;">
                        	<?php 
                                GetUsersForLoc($locval);
                            ?> 
                            </ul>
                        </ul>
                    </div>
                    <div id="sidebar" style="float:right;">
                    <div id="topusers" >
                    <div class="module newuser newuser-greeting" id="newuser-box" style="">
                        <h4 style="text-align:center;">Top Users <br>with accepted answers</h4>
                        <div>
                            <ul style="list-style-type: none;">
                            	<?php
                                    GetTopAcceptedUsersForLoc($locval, 11);
                                ?>
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div id="topbadges" >
                    <div class="module newuser newuser-greeting" id="newuser-box" style="">
                        <h4 style="text-align:center;">Top badges for <?php echo $locval; ?></h4>
                        <div>
                            <ul style="list-style-type: none;">
                                <?php
                                    GetTopBadgesForLoc($locval, 11);
                                ?>
                            </ul>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
		    </div>
		    <div class="footer">
            </div>
		</div>
	</body>
</html>