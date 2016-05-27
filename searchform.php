<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input placeholder="" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" onclick="this.value='';" autofocus="autofocus" onfocus="this.select()"/>
</form>