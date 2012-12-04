
<?//print_r($user);?>
<script>
x = <?=$lat['latitude']?>;
y = <?=$lat['longitude']?>;
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="map_canvas"></div>