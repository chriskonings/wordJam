<html>
	<head>
		<title>WordJam</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>

		<style type="text/css">
			body{margin: 0 auto; width: 100%; height: 100;background-color: black; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;}
			header{background-color:white; width: 100%; color: #000; padding: 10px; text-align: center;}
			#wrapper{margin:25px auto; max-width:960px; color: white; text-align: center;}
			#partyper{height: 200px; width: 75%; resize:none;}
			#steps{text-align: left;max-width: 320px;margin: 0 auto;padding: 30px;}
			.logo{width:100%; max-width: 100px; clear: both; display: block; margin: 0 auto;}
			.video-container { margin: 20px; position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden; } .video-container iframe, .video-container object, .video-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } 
			.videoInput{width: 35%; border: 1px solid black;}
			.tofield{clear: both; display: block; margin: 0 auto;}
			.messagefield{clear: both;display: block; margin: 0 auto;}
		</style>

		<script type="text/javascript">

			function playthevideo(){
				var myPlayer = document.getElementById('my-video');
				myPlayer.playVideo();
			};
			function stopthevideo(){
				var myPlayer = document.getElementById('my-video');
				myPlayer.stopVideo();
			};

			function pausethevideo(){
				var myPlayer = document.getElementById('my-video'); 
				myPlayer.pauseVideo();
			};

		</script>
	</head>
	<body>
						
		<header>

			<a href="http://chriskonings.com"><img class="logo" src="logo.png"></a>
			<h1><p>WordJam</p></h1>
			<p id="steps">Steps:
			<br/>1. Submit a YouTube video below and start typing.
			<br/>2. See if you can keep it up until the end of the video.
			<br/>3. Don't stop!</p>

			<form method="post" action="">
				<input class="videoInput" type="text" name="something" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>" />
				<input type="submit" name="submit" value="Submit" />
			</form>

			<?php
				$url = "http://youtu.be/cHI8M1K2LXs";
				if(isset($_POST['submit'])) {
					$url = htmlspecialchars($_POST['something']);
				}
				preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
			?>

		</header>


		<div id="wrapper">

			<p>Type In The Box Below</p>
			<form method="POST" action="mail.php" id="myform">
				To<input class="tofield" type="text" name="receiver"/>
				Message<textarea class="messagefield" id="partyper" name="mytextarea" rows="5" cols="10"> </textarea>
				<input type="submit" name="submit" value="submit" />
			</form>

			<div class="video-container">
				<?php echo $url ?>
				<div id="player"></div>
			</div>

		</div>

		<script>
			var tag = document.createElement('script');

			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var player;

			function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
					height: '100%',
					width: '100%',
					fs: '0',
					videoId: '<?php echo $matches[1]; ?>',
					events: {
						'onReady': onPlayerReady,
					}
				});
			}

			function onPlayerReady(event) {
			player.pauseVideo();
			}

			$( document ).ready(function() {

				var typingTimer;
				var doneTypingInterval = 2000;

				$('#partyper').keyup(function(){
					clearTimeout(typingTimer);
					player.playVideo();
					$('body').css('background-image', 'url(./party.gif)');
					typingTimer = setTimeout(doneTyping, doneTypingInterval);
				});

				function doneTyping () {
					$('body').css('background-image', 'url(./black.jpg)');
					player.pauseVideo();
				}

			});

		</script>

	</body>
</html>
