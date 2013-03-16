<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){
// Index of the currently 'active' section
var activeCache = null;

// Actual rendered height of a header element
var cloneHeight = function(){
    var $clone = $('<div class="clone"></div>').appendTo('body'),
        cloneHeight = $clone.outerHeight();
    $clone.remove();
    return cloneHeight;
}();

// Top offsets of each header
var offsets = [];

// Figure out which section is 'active'
var activeHeaderIndex = function(){
    var scrollTop = document.body.scrollTop;
    for ( var i = 0; i < offsets.length; i++ )
        if ( offsets[i] - cloneHeight > scrollTop )
            return Math.max( i - 1, 0 );
}

// Build the 'offsets' array
$('.header').each(function(i, obj){
    offsets.push( $(this).offset().top );
});

// Listen to scroll events
$(window).on('scroll', function(){
    var active = activeHeaderIndex(), 
        scroll = document.body.scrollTop,
        clone = $('.clone').length,
        $active = $('.header').eq(active),
        prevTitle = $('.header').eq(active - 1).text(),
        title = $active.text(),
        $fixed = $('.fixed');
    // Hide fixed header
    if ( offsets[active] > scroll ){
        if ( !clone ){
            $('.header').eq(0).hide();
            $('<li class="clone">' + prevTitle + '</li>').insertBefore($active);
        }
        $fixed.hide();
    // Show fixed header
    } else {
        if ( clone ){
            $('.header').eq(0).show();
            $('.clone').remove();
        }
        $fixed.show();
    }
    // If we're not changing headers, exit
    if ( active == activeCache ) return;
    // Update active index
    activeCache = active;
    // Remove old fixed header (if any)
    $('.fixed').remove();
    // Add a new fixed header
    $fixed = $('<div class="fixed">' + title + '</div>').appendTo('body');
}).trigger('scroll');

});//]]>  

</script>
	</head>

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
                </div>
			</div>
            <div id="content" style="float:left;width:930px;">
	            <div itemscope="" itemtype="http://schema.org/Article">
            	    <div id="Badge-header">
            		<h1 itemprop="name">
						<a href="/" class="question-hyperlink"></a>
					</h1>
                    </div>
                    <div id="BadgeList" style="float:left;width=500px;">
                    	User List
                    	<ul style="list-style-type: none;">
                        	<li><div class="user-info user-hover">
        												<div class="user-gravatar32">
            												<a href="/users/320/laxman13"><div class=""><img src="http://www.gravatar.com/avatar/bd9b9464b06f7d247df674c1f361fb2e?s=32&amp;d=identicon&amp;r=PG" alt="" width="32" height="32"></div></a>
        												</div>
        												<div class="user-details">
            												<a href="/users/320/laxman13">Laxman13</a><br>
            												<span class="reputation-score" title="reputation score" dir="ltr">4,659</span><span title="2 gold badges"><span class="badge1"></span><span class="badgecount">2</span></span><span title="10 silver badges"><span class="badge2"></span><span class="badgecount">10</span></span><span title="27 bronze badges"><span class="badge3"></span><span class="badgecount">27</span></span>
       											 		</div>
    												</div></li>
                            <li><div class="user-info user-hover">
        												<div class="user-gravatar32">
            												<a href="/users/320/laxman13"><div class=""><img src="http://www.gravatar.com/avatar/bd9b9464b06f7d247df674c1f361fb2e?s=32&amp;d=identicon&amp;r=PG" alt="" width="32" height="32"></div></a>
        												</div>
        												<div class="user-details">
            												<a href="/users/320/laxman13">Laxman13</a><br>
            												<span class="reputation-score" title="reputation score" dir="ltr">4,659</span><span title="2 gold badges"><span class="badge1"></span><span class="badgecount">2</span></span><span title="10 silver badges"><span class="badge2"></span><span class="badgecount">10</span></span><span title="27 bronze badges"><span class="badge3"></span><span class="badgecount">27</span></span>
       											 		</div>
    												</div></li>
                           <li><div class="user-info user-hover">
        												<div class="user-gravatar32">
            												<a href="/users/320/laxman13"><div class=""><img src="http://www.gravatar.com/avatar/bd9b9464b06f7d247df674c1f361fb2e?s=32&amp;d=identicon&amp;r=PG" alt="" width="32" height="32"></div></a>
        												</div>
        												<div class="user-details">
            												<a href="/users/320/laxman13">Laxman13</a><br>
            												<span class="reputation-score" title="reputation score" dir="ltr">4,659</span><span title="2 gold badges"><span class="badge1"></span><span class="badgecount">2</span></span><span title="10 silver badges"><span class="badge2"></span><span class="badgecount">10</span></span><span title="27 bronze badges"><span class="badge3"></span><span class="badgecount">27</span></span>
       											 		</div>
    												</div></li>
                        </ul>
                    </div>
                    <div id="sidebar" style="float:right;width:400px;">
                    <div class="module newuser newuser-greeting" id="newuser-box" style="">
                        <h4>Top 5 reputed users in California</h4>
                        <div>
                            <ul style="list-style-type: none;">
                            	<li> user1</li>
                                <li> user2</li>
                                <li> user3</li>
                                <li> user4</li>
                                <li> user5</li>
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