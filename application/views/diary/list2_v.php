    <script src="/include/js/jquery.infinitescroll.min.js"></script>


<?
 $('#content').infinitescroll({
 
    navSelector  : "div.navigation",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : "div.navigation a:first",    
                   // selector for the NEXT link (to page 2)
    itemSelector : "#content div.post"          
                   // selector for all items you'll retrieve
  });


// unbind normal behavior. needs to occur after normal infinite scroll setup.
$(window).unbind('.infscr');
// call this whenever you want to retrieve the next page of content
// likely this would go in a click handler of some sort
$(document).trigger('retrieve.infscr');


?>