<div class="col-md-4 col-sm-6">
	<div class="service-box image-box">
	    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	    <div class="content-box">
	        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	        <p><?php echo consultax_excerpt(17); ?></p>
	        <a class="link-box pagelink" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','consultax') ?></a>        
	    </div>
	</div>
</div>