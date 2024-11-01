<?php
/*
Plugin Name: Yahoo Friend Finder
Plugin URI: http://progvig.ir/yff
Description: Find other People On yahoo 
Author: payam khaninajad
Version: 1
Author URI: http://progvig.ir/
Author email: progvig@yahoo.com




== Comming Soon   ==

1. looking for invisible ids
2. Register new id witout connection To pc-aras.com
4. get randomly people on your site 
5. get last search
6. get last online users 
7. get last ivisible users
8. site admin state viewer on yahoo
9. get yahoo id profile information 
10. get hi5,facebook,etc
11. trace yahoo ids on google 
12. get last registerd people 
12. and more
*/

function Show_widget()
{
 ?>
<input type="text" name="yff_name" id="yff_name" />
				<input type="submit" value="Get result" onClick="$.get(yff_name.value)"  id="get" />
			<div id="result"  class="functions">
			</div>
			<div id="registration"  class="functions" style="visibility:hidden" >
			<input type="text" name="reg" />
			</div>
	 <script type="text/javascript" src="http://pc-aras.com/id/jquery-1.4.2.js"></script>
  <script type="text/javascript">
	$.ajaxSetup ({
		cache: false
	});
	var ajax_load = "<img class='loading' src='load.gif' alt='loading...' />";
	var loadUrl = "http://pc-aras.com/id/ajax-res.php";
//	$.get()
	$("#get").click(function(){
		$("#result").html(ajax_load);
		$.get(
			loadUrl+"?name="+$('input:text[name=yff_name]').val(),
			{language: "php", version: 5},
			function(responseText){
				$("#result").html(responseText);
			},
			"html"
		);
	});
	
//	$.post()
	$("#post").click(function(){
		$("#result").html(ajax_load);
		$.post(
			loadUrl,
			{language: "php", version: 5},
			function(responseText){
				$("#result").html(responseText);
			},
			"html"
		);
	});
 $(document).ready(function() {
   $("a").find('reg-menu').click(function() {
     alert("Hello world!");
   });
 });

</script>	
<?php
}
 function widget_yahooff($args) {
  extract($args);
 
  $options = get_option("widget_yahooff");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'Yahoo Friend Finder',
	   'registration' => 'checked="checked"'
      );
  }
 
  echo $before_widget;
    echo $before_title;
      echo $options['title'];
	     echo $options['registration'];
    echo $after_title;
    Show_widget();
  echo $after_widget;
}
 
function yahooff_control()
{
  $options = get_option("widget_yahooff");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'Yahoo Friend Finder',
	   'registration' => 'checked="checked"'
      );
  }
 
  if ($_POST['yahooff-Submit'])
  {
    $options['title'] = htmlspecialchars($_POST['yahooff-WidgetTitle']);
    update_option("widget_yahooff", $options);
  }
 
?>
  <p>
    <label>Title: </label>
    <input type="text" id="yahooff-WidgetTitle" name="yahooff-WidgetTitle" value="<?php echo $options['title'];?>" /><br />
  <label>Registration: </label>  <input type="checkbox" name="yahooff-registration"  <?php echo $options['registration'];?>"
    <input type="hidden" id="yahooff-Submit" name="yahooff-Submit" value="1" />
	<p>New Feature Comming Soon !</p>
  </p>
<?php
}
 
function yahooff_init()
{
  register_sidebar_widget(__('yahooff'), 'widget_yahooff');
  register_widget_control(   'yahooff', 'yahooff_control', 300, 200 );
}
add_action("plugins_loaded", "yahooff_init");
?>
 