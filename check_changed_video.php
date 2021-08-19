<?php
error_reporting(0);
session_start();
include('connection.php');
$loginemail=$_SESSION['loginmail'];
$vidoemainids=$_POST['videoid'];

	$sql = "SELECT v.*,m.user_image FROM video as v inner join myguests as m on v.user_email=m.email where v.id=".$vidoemainids."";
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
                       
                
	
	<?php
}}
  
	?>
	
	