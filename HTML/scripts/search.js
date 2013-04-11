function doSearch() {

  var searchText = document.getElementById('search').value;
  if(searchText==''){
    window.alert('Please enter a valid search query');
    return; 
  }

  var category = document.getElementById('category');
  var selected = -1;

  for(var i=0; i<category.options.length; i++) {

    if(category.options[i].selected == true) {
      selected = i;
      break;
    }
  
  }

  if(selected == 0) {

    if(searchText.indexOf(' ') != -1){
      window.alert('A Tag may not contain spaces');
      return;
    }

    //View Tag Info, if its exists
    window.location.assign("tag.php?tag="+searchText); 
  
  } else {
 
    //View Search results for Posts 
    var searchQuery=escape(searchText);
    window.location.assign("searchPosts.php?query="+searchQuery); 
  
  }


}

function expand(box) {

  box.style.width = "250px";

}

function shrink(box) {

  box.style.width = "100px";

}
