<?php

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
            </div> ';
           

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

?>
