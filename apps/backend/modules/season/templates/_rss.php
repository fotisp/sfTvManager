<a href="<?php echo $season->getFeed()?>" target="_blank"><?php 
	echo 				image_tag(
										'rss',
										array(
											'border'=>0,
											'alt'=>'feed',
											'title'=>$season->getFeed()
										)
							);
?></a>
