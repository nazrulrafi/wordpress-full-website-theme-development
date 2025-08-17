<form role="search" method="get" class="header__search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="hide-content"><?php _e( 'Search for:', 'your-text-domain' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type Keywords', 'your-text-domain' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'your-text-domain' ); ?>" autocomplete="off">
    </label>
    <input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'your-text-domain' ); ?>">
</form>
