<?php
error_reporting(0);
session_start();
include('connection.php');
$loginemail=$_SESSION['loginmail'];
$sql = "SELECT * FROM myguests where email like '".$loginemail."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result -> fetch_row()) {
		$firstname=$row['3'];
		$lastname=$row['4'];
		$work=$row['5'];
		$imgpath=$row['7'];
	}
}
	$videocount="SELECT * FROM video where user_email like '".$loginemail."'";
	$videoresult = $conn->query($videocount);
	$totlmyvideo=$videoresult->num_rows;
?>
<div class="profile-form">
                    <div class="profile-edit">
                        <a href="edit-profile.html">
                        <?php if($imgpath!='' ){ ?>
                        <img src="<?php echo $imgpath; ?>" alt="" class="profile-img">
                        <?php }else{ ?>
                         <img src="assets/img/pro.png" alt="" class="profile-img">
                        
                        <?php

                        } ?>
                        </a>
                    </div>
                    <h3 class="user-name"><?php echo $firstname; ?></h3>
                    <p class="work"><?php echo $work; ?></p>
                    <div class="profile-updates">
                        <div class="pro-count">
                            <p><b>Posts</b></p>
                            <span class="count"><?php echo $totlmyvideo; ?></span>
                        </div>
                        <div class="pro-count">
                            <p><b>Posts</b></p>
                            <span class="count"><?php echo $totlmyvideo; ?></span>
                        </div>
						<div class="pro-count">
                            <p><b>Posts</b></p>
                            <span class="count"><?php echo $totlmyvideo; ?></span>
                        </div>
                    </div>
                    
                </div>
                <div class="posts">
                    <h5>Posts</h5>
					<?php while ($rowc = $videoresult -> fetch_row()) { ?>
                    <div class="post-video">
                        <video width="400" controls>
                            <source src="<?php echo $rowc['2']; ?>" type="video/mp4">
                            <source src="<?php echo $rowc['2']; ?>" type="video/ogg">
                        </video>
                    </div>
					<?php } ?>
                    
                </div>
	