<?php
/*
Template Name: Login
*/
// Custom login page
if($_POST) {

	global $wpdb;

	//We shall SQL escape all inputs
	$username = esc_sql($_REQUEST['username']);
	$password = esc_sql($_REQUEST['password']);
	$remember = "false";

	$login_data = array();
	$login_data['user_login'] = $username;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember;

	$user_verify = wp_signon( $login_data, false ); 

	if ( is_wp_error($user_verify) ) 
	{
	   header("Location: " . home_url() . "/login/error/");
	   // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.
	 } else {	
	   echo "<script type='text/javascript'>window.location='". home_url() ."'</script>";
	   exit();
	 }

} else {

	// No login details entered - you should probably add some more user feedback here, but this does the bare minimum

	//echo "Invalid login details";

}

get_header();
?>

<style>
    /*Hide the site main menu on the login page*/
    #site-navigation{
        display: none;
    }
</style>

<div class="container from-the-blog">
	<div class="row">
		<div id="primary" class="col-md-12 hfeed">
			<div class="page-header clearfix">
				<h1 class="pull-left"><?php the_title(); ?></h1>
			</div>

			<div class="row">					
                <div class="col-md-12" >
                    <form class="form-horizontal" id="login" name="form" action="<?php echo home_url(); ?>/login/" method="post">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-3">
                          <input class="form-control" id="username" type="text" placeholder="Username" name="username">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-3">
                          <input class="form-control" id="password" type="password" placeholder="Password" name="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Remember me
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default" id="submit" name="submit" value="Submit" >Sign in</button>
                        </div>
                      </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>

<?php if ( ! is_front_page() ) get_footer(); ?>
