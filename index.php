<?php
function get_files($type) {
    $files = glob("./files/" . $type ."/*.mp3");
    asort($files);
    return $files;
}
if(isset($_REQUEST["skip"])){
    $files = get_files($_REQUEST["type"]);
    $targets = array_slice($files, $_REQUEST["skip"], 10);
}
?><html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>study duo</title>
<style>
input { border: 1px solid brack; border-radius: 0.25em; padding: 0.5em}
</style>
</head>
<body>
<div>
  <h1>duo学習</h1>
</div>
</div>
  <form>
  <div>
    <label>
       <input type="radio" name="type" value="basic" checked/>
       basic                                
    </label>                                
    <label>
       <input type="radio" name="type" value="review"/>
       review                                
    </label>
  </div>
  <div>
    <input type="number" name="skip" value="<?php echo $_REQUEST['skip']?>"/>
    <input type="submit" value="生成"/>
    <input type="button" value="再生" onclick="play();"/>
  </div>
  </form>
</div>
<div>
<audio id='audio' controls></audio>
</div>
<?php
foreach($targets as $e){
  echo "<li>". basename($e) . "</li>";
}
?>
<script type="text/javascript">
function play(){        
  var playlist = [
  <?php
      foreach($targets as $e){
        echo "'". $e . "',";
      }
  ?>
  ];
  var audio = document.getElementById('audio');
  audio.volume = 1.0;
  audio.src = playlist[0];
  audio.play();
  var index = 0;
  audio.addEventListener('ended', function(){
    index++;
    if (index < playlist.length) {
      audio.src = playlist[index];
      audio.play();
    }
    else {
      alert("ended");
    }
  });
}
</script>  
</body>
</html>
