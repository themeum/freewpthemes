<form method="get" class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>" >
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search ...','calcio' ); ?>" autocomplete="off" />
    <button class="btn btn-primary btn-style btn-search"><i class="fa fa-search"></i></button>
</form>