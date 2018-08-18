<style>
#searchbox {
	float:left;
	
}
</style>

<form action="<?php echo home_url( '/' ); ?>"  id="searchbox" method="get">

	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
	<!--<input type="submit" alt="Search" value="<?php echo '<i class="fi-magnifying-glass" style="color:#fff;"></i>'; ?>" />-->
	

</form>