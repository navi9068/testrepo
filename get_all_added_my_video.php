<?php
error_reporting(0);
session_start();
include('connection.php');
$loginemail=$_SESSION['loginmail'];
if($loginemail !=''){
	$sql = "SELECT v.*,m.user_image FROM video as v inner join myguests as m on v.user_email=m.email where v.status=1 and v.user_email like '".$loginemail."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result -> fetch_row()) {
   $videoid=$row[0];
   $videolike = "SELECT * FROM video_like where video_id=".$videoid."";
   $videolikeresult = $conn->query($videolike);
   $videolikecount=$videolikeresult->num_rows;
   $video_dislike = "SELECT * FROM video_dislike where video_id=".$videoid."";
   $video_dislikeresult = $conn->query($video_dislike);
   $video_dislikeresultcount=$video_dislikeresult->num_rows;
   
   $videouser=$row[6];
   $video_follower = "SELECT * FROM videofollower where video_user='".$videouser."'";
   $video_followerresult = $conn->query($video_follower);
   $video_followerresultcount=$video_followerresult->num_rows;
   $videousercheck=$row[7];
   if($videousercheck){
	   $userimage=$videousercheck;
   }else{
	   $userimage="assets/img/photo-camera.png";
   }
	?>
	  <div class="single-video" id="videoids<?php echo $videoid; ?>">
                    <div class="video-img">
                        <video width="400" controls>
                            <source src="<?php echo $row[2];?>" type="video/mp4">
                            <source src="<?php echo $row[2];?>" type="video/ogg">
                        </video>
                    </div>
                    <div class="video-content">
                        <h4><a href="#" class="video-title"><?php echo $row[1];?></a></h4>
                        <div class="video-counter" id="videocounters<?php echo $row[0];?>">
                            <div class="video-viewers">
							<a href="#" class="followthisvideo" data-id="<?php echo $row[0];?>" data-user="<?php echo $row[6];?>">
                                <img src="<?php echo $userimage; ?>"/> <span><?php echo $video_followerresultcount; ?></span>
								</a>
                            </div>
                            <div class="video-feedback">
                                <div class="video-like-counter">
								<a href="#" class="likethisvideo" data-id="<?php echo $row[0];?>">
                                    <i class="fa fa-thumbs-o-up"></i> <span><?php echo $videolikecount; ?></span>
									</a>
                                </div>
                                <div class="video-like-counter">
								<a href="#" class="deslikethisvideo" data-id="<?php echo $row[0];?>">
                                    <i class="fa fa-thumbs-o-down"></i>
                                    <span><?php echo $video_dislikeresultcount; ?></span>
									</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	
	<?php
  }
  $sqlupdate = "UPDATE video SET status=2";
	$conn->query($sqlupdate);
	?>
	<script>
        $(document).ready(function(){
        $(".main").onepage_scroll({
          sectionContainer: ".single-video",
          responsiveFallback: 0,
          loop: true
        });
          });
          
      </script>
	<?php
}else{
	?>
	
	<?php
}
}else{
	echo "not login";
}

?>