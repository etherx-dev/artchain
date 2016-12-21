<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="<?=base_url()?>js/jquery_ui/jquery.ui.css"> 
  <script src="<?=base_url()?>js/jquery_ui/jquery.js"></script>
  <script src="<?=base_url()?>js/jquery_ui/jquery.ui.js"></script>
</head>
<body>
 
  <input type="text" id="tags" name="tags" />
 
 
</body>
</html>


<script type="text/javascript">
var $j = jQuery.noConflict();
  $j(function(){
  $j("#tags").autocomplete({
    source: "Home/get_tags" // path to the get_birds method
  });
});
</script>