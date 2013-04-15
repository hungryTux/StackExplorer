    <?php 

    include 'functions.php';
    include 'urlHandler.php';
    $handler = new UrlHandler($_GET);
    $locval = $handler->get_var("loc"); 

    printHeader();

   ?>


    	<div class="container" style="width:990px;">
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
                           <ul class="list">
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
                            <ul class="list">
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
                            <ul class="list">
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
 <?php printFooter(); ?>
