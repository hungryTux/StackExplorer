<?php

  function printHeader() {
    $html = '<html>
               <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <title>StackExplorer</title>
                <link rel="stylesheet" type="text/css" href="css/style.css">
               </head>
             <body>';

    print $html;

    printLogo();
  }

  function printFooter() {
    $html = '<br/><br/>
             <hr>
            </body>
         </html>';

    print $html;
  }

  function printLogo() {

    $html = '<script type="text/javascript" src=scripts/search.js></script>
          <div style="display: inline-block; padding: 2px;"><a href="tagCloud.php"><img src="images/logo.png"></a></div>
          <div style="float:right; padding:30px 60px 30px">
            <table cellpadding="0px" cellspacing="0px">
             <tr>
               <td style="border-style:solid;border-color:#CCCCCC;border-width:1px;"> 
                <select id="category" style="border-style: none; background-color:lightblue">
                  <option value=0 selected=true>Tags</option>
                  <option value=1>Posts</option>
                </select>
               </td>
               <td style="border-style:solid;border-color:#CCCCCC;border-width:1px;"> 
                <input type="text" id="search" onkeypress="expand(this);" onblur="shrink(this);" value="" style="width:100px; border:0px solid; height:18px; padding:0px 1px;">
               </td>
               <td style="border-style:solid;border-color:#CCCCCC;border-width:1px;"> 
                <input type="button" value="Go" style="border-style: none; background-color:lightblue;" onClick="doSearch();">
               </td>
             </tr>
            </table>
            </div><br/><br/><hr>';
           

    print $html;
  }

  function printUserProfile($userId) {

    require_once 'dbUtil.php';

    $html = '';

    $db = new dbUtil();

    $sql = "SELECT DisplayName,WebsiteUrl,Location,Age,AboutMe,Reputation,Views,UpVotes,DownVotes FROM ssriram.Users WHERE Id='".$userId."'";

    if($db->query($sql)) {

      $html .= '<table width="80%" height="100%" border="0" cellpadding="0" cellspacing="5">';

      while ($row = $db->fetch()) {

        //var_dump($row);

        $html .= "<tr><td colspan=2 align='center'>".$row['DISPLAYNAME']."</td></tr>";

        if($row['ABOUTME'] != NULL)
         $html .=  "<tr><td>About Me</td><td>".$row['ABOUTME']->load()."</td></tr>";
        else
         $html .=  "<tr><td>About Me</td><td></td></tr>";

        if($row['WEBSITEURL'] != NULL)
         $html .=  "<tr><td>URL</td><td>".$row['WEBSITEURL']."</td></tr>";
        else
         $html .=  "<tr><td>URL</td><td></td></tr>";

        if($row['LOCATION'] != NULL)
         $html .=  "<tr><td>Location</td><td>".$row['LOCATION']."</td></tr>";
        else
         $html .=  "<tr><td>Location</td><td></td></tr>";

        if($row['AGE'] != NULL)
         $html .=  "<tr><td>Age</td><td>".$row['AGE']."</td></tr>";
        else
         $html .=  "<tr><td>Age</td><td></td></tr>";

        $html .=  "<tr><td>Reputation</td><td>".$row['REPUTATION']."</td></tr>";
        $html .=  "<tr><td>Profile Views</td><td>".$row['VIEWS']."</td></tr>";
        $html .=  "<tr><td>Up Votes</td><td>".$row['UPVOTES']."</td></tr>";
        $html .=  "<tr><td>Down Votes</td><td>".$row['DOWNVOTES']."</td></tr>";

      }

      //Prepare for next query
      $db->free_statement();

      //Next Query 
      $sql = "SELECT distinct Name FROM ssriram.Badges WHERE userId='".$userId."'";

      if($db->query($sql)) {

         $badges = '';

         while ($row = $db->fetch()) {
            
           if($row['NAME'] != NULL){
             
             if($badges == '')
              $badges .= $row['NAME'];
             else
              $badges .= ', '.$row['NAME'];
           
           }


         }

         $html .=  "<tr><td>Badges Earned</td><td>".$badges."</td></tr>";
      
      }


      $html .=  '</table>';


      print $html;
    
    }

    //No more queries to be made for this page.
    //All done! Close connection.
    $db->done();
  
  
  }

  function getPost($postid)
  {
    require_once 'dbUtil.php';

    $array=array();


    $db = new dbUtil();
    $sql ="Select title,body,acceptedanswerid from ssriram.posts where id=".$postid;

    if($db->query($sql))
    {
      $row = $db->fetch();
      $array[0]=$row['TITLE'];
      $array[1]=$row['BODY']->load();
      $post_answer_id=$row['ACCEPTEDANSWERID'];

    }
    else
    {
      print("error");
    }

    $db->free_statement();

    $sql = "SELECT BODY FROM ssriram.POSTS WHERE ID=".$post_answer_id;

    if($db->query($sql))
    {
      $row = $db->fetch();
      if($row['BODY'] != null){
       $array[2]=$row['BODY']->load();
      } else {
       $array[2]='No Answer Yet';
      }
    }
    else
    {
      print("error");
    }

    $db->done();

    return $array;
  }   

  function GetQuestionsForTag($tagval,$bool,$num) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $compval = 'is null';
      if($bool==  1){
          $compval= '>0';
      }
      $cnt=0;
      $sql = "SELECT * from(SELECT p.title as TITLE, p.id as ID from ssriram.posts p 
        join (SELECT count(*) as cnt, postid from ssriram.votes where votetypeid=5 
        group by postid order by cnt desc)v on v.postid=p.id  
        where p.acceptedanswerid ".$compval." and p.tags like '%<".$tagval.">%' 
        order by v.cnt desc )where rownum < ".$num;
      //$sql = "SELECT p.title as TITLE, p.id as ID from ssriram.posts p join ( SELECT count(*) as cnt, postid from ssriram.votes where votetypeid=5 and rownum < ".$num." group by postid ) v on v.postid=p.id  where p.acceptedanswerid ".$compval." and p.tags like '<%".$tagval."%>' order by v.cnt desc";
      if($db->query($sql)) {
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              if($bool==1) {
                $html= $html."<a href=\"viewPost.php?postId=".$row['ID']."\">";
              } else {
                $html= $html."<a href=\"unanswered.php?postId=".$row['ID']."\">";
              }
              $html=$html.$row['TITLE'];
              $html=$html."</a></li>";
          }
      }
      if($cnt ==0) {
        if($bool==0) {
            $html="No Unanswered Questions";
        }
      }
      print $html;
      $db->done();
  }

  function GetUsersForTag($tagval,$num) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $cnt=0;
      //select s.displayname from (select owneruserid from SSRIRAM.posts where rownum < 6 and 
      // tags like '%<ajax>%' group by owneruserid order by count(*) desc) 
      // o join ssriram.users s on o.owneruserid = s.id;
      $sql = "SELECT s.displayname as DNAME, s.id as ID from (
        SELECT owneruserid from SSRIRAM.posts where tags like '%<".$tagval.">%' 
        group by owneruserid order by count(*) desc) o join SSRIRAM.users s on 
        o.owneruserid = s.id where rownum < ".$num;
      //echo $sql;
      
      if($db->query($sql)) {
          //echo "<a href=\"userProfile.php?userId=".$row['ID']."\">assds</a>";
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              $html= $html."<a href=\"userProfile.php?userId=".$row['ID']."\">";
              $html=$html.$row['DNAME'];
              $html=$html."</a></li>";
          }
      }
      if($cnt ==0) {
        
        $html="No Users";
      }
      print $html;
      $db->done();
  }

  function GetPostData($postID) {
    require_once 'dbUtil.php';
    $html = '';
    $db = new dbUtil();
    $obj = new Post();
    $sql = "SELECT TITLE from SSRIRAM.posts where ID=".$postID;
    if($db->query($sql)) {
      while ($row = $db->fetch()) {
        $obj->title=$row['TITLE'];
      }
    }
    return $obj;
    $db->done();
  }

  function GetTopUsersForBadges($badgeval,$num) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $cnt=0;
      //select s.displayname from (select owneruserid from SSRIRAM.posts where rownum < 6 and 
      // tags like '%<ajax>%' group by owneruserid order by count(*) desc) 
      // o join ssriram.users s on o.owneruserid = s.id;
      /*select * from (
        select u.displayname, o.userid from ssriram.users u 
        join 
        (select a.owneruserid as userid,count(*) as cnt  from ssriram.posts p 
          join ssriram.posts a on a.acceptedanswerid = p.id and a.owneruserid is not null group by a.owneruserid) o 
        on o.userid=u.id 
        where u.id in (select userid from ssriram.badges where name='Teacher') 
        order by o.cnt desc) 
      where rownum < 6 */
      $sql = "SELECT * from (
        SELECT u.displayname as UNAME, o.userid as ID from ssriram.users u 
        join 
        (SELECT a.owneruserid as userid, count(*) as cnt  from ssriram.posts p 
          join ssriram.posts a on a.acceptedanswerid = p.id and a.owneruserid is not null group by a.owneruserid) o 
        on o.userid=u.id 
        where u.id in (select userid from ssriram.badges where name='".$badgeval."') 
        order by o.cnt desc)
      where rownum < ".$num;
      
      
      if($db->query($sql)) {
          //echo "<a href=\"userProfile.php?userId=".$row['ID']."\">assds</a>";
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              $html= $html."<a href=\"userProfile.php?userId=".$row['ID']."\">";
              $html=$html.$row['UNAME'];
              $html=$html."</a></li>";
          }
      }
      if($cnt ==0) {
        
        $html="No Users";
      }
      print $html;
      $db->done();
  }

  function GetTopLocationsForBadges($badgeval,$num) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $cnt=0;
      //select s.displayname from (select owneruserid from SSRIRAM.posts where rownum < 6 and 
      // tags like '%<ajax>%' group by owneruserid order by count(*) desc) 
      // o join ssriram.users s on o.owneruserid = s.id;
      /*select count(*),location from ssriram.users 
      where id in (select userid from ssriram.badges where name='Teacher') 
      group by location order by count (*) desc;*/
      $sql = "SELECT * from (SELECT location from ssriram.users where location is not null and id in (SELECT userid from ssriram.badges where name='".$badgeval."') group by location order by count (*) desc) where rownum < ".$num;
      
      if($db->query($sql)) {
          //echo "<a href=\"userProfile.php?userId=".$row['ID']."\">assds</a>";
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              $html= $html."<a href=\"locations.php?loc=".$row['LOCATION']."\">";
              $html=$html.$row['LOCATION'];
              $html=$html."</a></li>";
          }
      }
      if($cnt ==0) {
        
        $html="No Users";
      }
      print $html;
      $db->done();
  }

  function GetUsersForLoc($locval) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $cnt=0;
      $sql = "SELECT id, displayname from ssriram.users where location='".$locval."'";
      
      if($db->query($sql)) {
          //echo "<a href=\"userProfile.php?userId=".$row['ID']."\">assds</a>";
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              $html= $html."<a href=\"userProfile.php?userId=".$row['ID']."\">";
              if($row['DISPLAYNAME']==' ') {
                $html=$html."user".$row['ID']."</a>";
              } else  {
                $html=$html.$row['DISPLAYNAME']."</a>";
              }
              $html=$html."</li>";
          }
      }
      if($cnt ==0) {
        
        $html="No Users";
      }
      print $html;
      $db->done();
  }

  function GetTopAcceptedUsersForLoc($locval, $num) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $cnt=0;
      $sql = "SELECT * from (select u.id as ID,u.displayname as DISPLAYNAME from 
        SSRIRAM.users u join (select a.owneruserid as userid,count(*) as cnt  from 
        ssriram.posts p join ssriram.posts a on a.acceptedanswerid = p.id 
        and a.owneruserid is not null group by a.owneruserid) o on o.userid=u.id 
        where location='".$locval."' order by o.cnt desc) where rownum < ".$num;
      
      if($db->query($sql)) {
          //echo "<a href=\"userProfile.php?userId=".$row['ID']."\">assds</a>";
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              $html= $html."<a href=\"userProfile.php?userId=".$row['ID']."\">";
              if($row['DISPLAYNAME']==' ') {
                $html=$html."user".$row['ID']."</a>";
              } else  {
                $html=$html.$row['DISPLAYNAME']."</a>";
              }
              $html=$html."</li>";
          }
      }
      if($cnt ==0) {
        
        $html="No Users";
      }
      print $html;
      $db->done();
  }

  function GetTopBadgesForLoc($locval, $num) {

      require_once 'dbUtil.php';

      $html = '';

      $db = new dbUtil();
      $cnt=0;
      $sql = "SELECT * from (select b.name, count(*) as cnt from 
        (select * from ssriram.badges where userid is not null) b join 
        (select * from ssriram.users where location='".$locval."') u 
        on b.userid=u.id group by b.name order by cnt desc) 
        where rownum < ".$num;
      
      if($db->query($sql)) {
          //echo "<a href=\"userProfile.php?userId=".$row['ID']."\">assds</a>";
          while ($row = $db->fetch()) {
              $cnt=$cnt+1;
              $html=$html."<li>";
              $html= $html."<a href=\"badges.php?badge=".$row['NAME']."\">"; 
              $html=$html.$row['NAME']."</a>";
              $html=$html."</li>";
          }
      }
      if($cnt ==0) {
        
        $html="No Users";
      }
      print $html;
      $db->done();
  }

?>
