#!/usr/local/bin/php
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
	</head>
	<?php 
    include 'functions.php';
	$tagval = $_GET["tag"]; ?>
  
	<body class="tag-page">
    	<div class="container" style="width:990px;">
			<div id="header" style="float:left;">
				<div id="topbar">
                <br class="cbt"/>
				<br class="cbt"/>
				<div id="hlogo" style="float:left;margin:57px 12px 0 0;overflow:hidden;">
					<a href="/" style="display:block;width:200px">Stack Explorer</a>
				</div>
				<div id="hmenus" style="margin:57px 12px 0 0;overflow:hidden;">
          <!--
          <div class="nav mainnavs">
						<ul>
							<li class="youarehere" >
								<a id="nav-questions" href="/questions">Questions</a>
							</li>
							<li>
								<a id="nav-tags" href="/tags">Tags</a>
							</li>
							<li>
								<a id="nav-users" href="/users">Users</a>
							</li>
							<li>
								<a id="nav-badges" href="/badges">Badges</a>
							</li>
							<li>
								<a id="nav-unanswered" href="/unanswered">Unanswered</a>
							</li>
						</ul>
					</div>
          -->
                </div>
			</div>
            <div id="content" style="float:left;width:930px;">
	            <div itemscope="" itemtype="http://schema.org/Article">
           	      <div id="Badge-header">
            		<h1 itemprop="name" style="text-align:center;"><?php echo $tagval; ?></h1>
                    </div>
                    <div id="TagDetails" style="float:left;position:absolute;
left:0;">
                    <div id="Answered List" style="">
                    	Answered Questions
                    	<ul style="list-style-type: none;">
                        <?php 
                          
                          GetQuestionsForTag($tagval,1,6);
                        ?> 	
                      </ul>
                    </div>
                    <div id="Unanswered List" style="">
                    	Unanswered Questions
                    	<ul style="list-style-type: none;">
                        <?php
						 
                          	GetQuestionsForTag($tagval,0,6);
                        ?> 
                        </ul>
                    </div>
                    </div>
                    <div id="sidebar" style="float:right;">
                    <div class="module newuser newuser-greeting" id="newuser-box" style="">
                        <h4 style="text-align:center;">Top Users</h4>
                        <div>
                            <ul style="list-style-type: none;">
                            	<?php
                                    GetUsersForTag($tagval,6);
                                ?> 
                            </ul>
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