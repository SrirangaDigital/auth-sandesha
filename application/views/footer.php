	<script type="text/javascript" src="<?=PUBLIC_URL?>js/viewer.js"></script>
	<script type="text/javascript">
		var vieweroptions = { url: 'data-original' };
		if(document.getElementById('imageViewer'))
			var viewer = new Viewer(document.getElementById('imageViewer'), vieweroptions);
	</script>
</body>
</html>