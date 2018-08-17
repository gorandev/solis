// Item Name: Sticky Header
// Author: Mapalla
// Author URI: http://codecanyon.net/user/Mapalla
// Version: 1.0

(function($){

  //start of plugin
  $.fn.stickyheader = function(options) {
  
  var defaults = {hidden:false};
  
  var o = jQuery.extend(defaults, options);
  
  return this.each(function(){
    var sh = $(this);
    createMinimizeControl(sh);
    createMaximizeContol(sh);
    sh.minimizeControl = sh.children('#minimize');
    sh.maximizeControl = sh.children('#maximize');
    sh.fullHeight = sh.outerHeight();
    sh.maximizeControlTopPos = sh.maximizeControl.css('top') ;
    
    sh.minimizeControl.bind('click', sh, minimizeClick); 
    
    sh.maximizeControl.bind('click', sh, maximizeClick);  
	   
  }); // end of return
    
  }; //end of plugin
  
  //function here 
  
  //create hidden control
  function createMinimizeControl(sh){
    sh.append('<div id="minimize"></div>');
  } 
  
  //create display control
  function createMaximizeContol(sh){
    sh.append('<div id="maximize"></div>');
  }
  
  //show display control
  function showMaximizeControl(sh){
    sh.maximizeControl.animate({'top': sh.fullHeight + 'px'});
  }
  
  //hidden display control
  function hiddenMaximizeControl(sh){
    sh.maximizeControl.animate({'top': sh.maximizeControlTopPos});
  }
  
  //show sticky header
  function showStickyHeader(sh){
    sh.animate({'top': '0px'});
  }
  
  //hidden sticky header
  function hiddenStickyHeader(sh){
    sh.animate({'top':'-' + sh.fullHeight + 'px'});
  }
  
  //minimize click event
  function minimizeClick(event){
    var $this = $(this);
    var sh = event.data;
    
    hiddenStickyHeader(sh);
    showMaximizeControl(sh);
    
  }
  
  //maximize click event
  function maximizeClick(event){
    var $this = $(this);
    var sh = event.data;
    
    hiddenMaximizeControl(sh);
    showStickyHeader(sh);
  }
  
		
})( jQuery );
