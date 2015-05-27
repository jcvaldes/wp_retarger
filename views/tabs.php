<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h2><?php esc_attr_e( 'WP Retarger Tools', 'wp_admin_style' ); ?></h2>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

					<div class="postbox">

						<div class="inside">

							<div role="tabpanel">
								<h3 class="nav-tab-wrapper">
									<a class="nav-tab nav-tab-active"
										rel="avp_unicode_charkbd_admin_menu_panel_0"
										href="javascript:void( 0 );"
										title="Click to change display to Braille"> Router </a> <a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_1"
										href="javascript:void( 0 );"
										title="Click to change display to Common"> Picture Redirect </a>
									<a class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_2"
										href="javascript:void( 0 );"
										title="Click to change display to Computers"> Popup </a> <a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_3"
										href="javascript:void( 0 );"
										title="Click to change display to Dingbats"> Pixel </a>
								</h3>
								<!-- Nav tabs -->
								<form name="wp_retarger_form" method="post" action="?page=wp_retarger" enctype="multipart/form-data">

									<input type="hidden" name="wp_retarger_form_send" value="S" />

									<table class="form-table nav-tab-contents" id='avp_unicode_charkbd_admin_menu_panel_0'>
										<col width=" 10%">
											<col width="90%">
												<tr valign="top" class="even">
													<td><strong>Name</strong></td>
													<td>
														<input type="text" id="name_router" name="name_router" style="width: 30%" value="<?= $edit['name_router'] ?>" />
													</td>
												</tr>
												<tr valign="top" class="odd">
													<td><strong>Url Embed</strong></td>
													<td>
														<input type="text" id="urlembed_router" name="urlembed_router" style="width: 30%" value="<?= $edit['urlembed_router'] ?>" />
													</td>

												</tr>


									</table>
									<table class="form-table nav-tab-contents" id='avp_unicode_charkbd_admin_menu_panel_1' style='display: none;'>


										<tbody>
											<tr valign="top" class="even">
												<td><strong>Url Image</strong></td>
												<td>
													<input type="text" id="url_image_redirect" name="url_image_redirect" style="width: 50%" />
													<input type="file" name="myfile" id="myfile">
												</td>
											</tr>
											<tr valign="top" class="odd">
												<td><strong>Description</strong></td>
												<td>
													<input type="text" id="url_image_redirect" name="url_image_redirect" style="width: 50%" />
												</td>
											</tr>


										</tbody>

									</table>
									<table class="form-table nav-tab-contents"
										id='avp_unicode_charkbd_admin_menu_panel_2'
										style='display: none;'>


										<tbody>
											<tr valign="top" class="even">
												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup1.jpg'?>" width="180" height="120" /><div class="pt-10"/><input type="radio" name="popup-type"  value="1"><strong>Type 1</strong></td>												
												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup2.jpg'?>" width="180" height="120" /><div class="pt-10"/><input type="radio" name="popup-type"  value="1"><strong>Type 2</strong></td>
												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup3.jpg'?>" width="180" height="120" /><div class="pt-10"/><input type="radio" name="popup-type"  value="1"><strong>Type 3</strong></td>																								
											</tr>
											<tr>
											<td colspan="3">
											 <strong>Popup Type 1: </strong> 
											 Por Url: <input type="radio" name="popup-type1"  value="1">
											 Por HTML: <input type="radio" name="popup-type1"  value="2">
											</td>
											</tr>
											
											<tr>
											<td colspan="3">
											 <strong>Dimensiones: </strong> 
											 Ancho: <input type="text" name="popup-width"  value="800" maxlength="4"  style="width:50px">px
											 Alto: <input type="text" name="popup-height"  value="600" maxlength="4" style="width:50px">px
											</td>
											</tr>
											
										    <tr>
											<td colspan="3">
											 <strong>URL: </strong> 
											 <input type="text" name="url-popup"  maxlength="255"  style="width:500px">
											</td>
											</tr>
											
										</tbody>

									</table>
									<table class="form-table nav-tab-contents" id='avp_unicode_charkbd_admin_menu_panel_3' style='display: none;'>


										<tbody>
											<tr valign="top" class="even">
												<td>
													<textarea id="wp_retarger_pixel" name="wp_retarger_pixel" rows="5" cols="80"><?= $edit['pixel'] ?></textarea></td>
											</tr>
										</tbody>

									</table>
									<p>
										<input class="button-primary" type="submit" name="wp_retarger_username_submit" value="Guardar" />
									</p>
									<?php if(isset($edit['ID'])){ ?>
											<input type="hidden" name="_action" value="edit">
											<input type="hidden" name="id" value="<?= $edit['ID'] ?>">
									<?php } ?>
								</form>


							</div>

						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h3>
							<span><?php

    esc_attr_e('Sidebar Content Header', 'wp_admin_style');
    ?></span>
						</h3>

						<div class="inside">
							<p>
								<?php esc_attr_e( 'Everything you see here, from the documentation to the code itself, was created by and for the community. WordPress is an Open Source project, which means there are hundreds of people all over the world working on it. (More than most commercial platforms.) It also means you are free to use it for anything from your cat’s home page to a Fortune 500 web site without paying anyone a license fee and a number of other important freedoms.', 'wp_admin_style'); ?>
							</p>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div>
<!-- .wrap -->