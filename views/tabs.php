
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
													<input type="text" id="url_image_redirect" name="url_image_redirect" style="width: 50%"  value="<?php echo (isset($edit['popup']['image'])) ? $edit['popup']['image'] : ''  ?>"/>
													<input type="file" name="picture" id="picture">
												</td>
											</tr>
											<tr valign="top" class="odd">
												<td><strong>Description</strong></td>
												<td>
													<input type="text" id="url_image_redirect_description" name="url_image_redirect_description" style="width: 50%" />
												</td>
											</tr>


										</tbody>

									</table>
									<table class="form-table nav-tab-contents" id='avp_unicode_charkbd_admin_menu_panel_2' style='display: none;'>


										<tbody>
											<tr valign="top" class="even">
												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup1.jpg'?>" width="180" height="120" />
													<div class="pt-10" />
													<input type="radio" class="popup-type" name="popup-type" value="1" checked><strong>Type 1</strong></td>
												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup2.jpg'?>" width="180" height="120" />
													<div class="pt-10" />
													<input type="radio" class="popup-type two" name="popup-type" value="2"><strong>Type 2</strong></td>
												<td><img src="<?php echo plugin_dir_url( __FILE__ )  . '../img/popup3.jpg'?>" width="180" height="120" />
													<div class="pt-10" />
													<input type="radio" class="popup-type tres" name="popup-type" value="3"><strong>Type 3</strong></td>
											</tr>

											<tr class="for-type-2">
												<td colspan="3">
													<strong>Dimensiones: </strong> Ancho:
													<input type="text" name="popup-width" value="<?php echo (isset($edit['popup']['width'])) ? $edit['popup']['width'] : '800'  ?>" maxlength="4" style="width:50px">px Alto:
													<input type="text" name="popup-height" value="<?php echo (isset($edit['popup']['height'])) ? $edit['popup']['height'] : '600'  ?>" maxlength="4" style="width:50px">px
												</td>
											</tr>

											<tr class="for-type-2">
												<td colspan="3">
													<strong>Popup Type: </strong>
													Por Url: <input type="radio" class="popup-show" name="popup-show" value="url" checked>
													Por HTML: <input type="radio" class="popup-show html" name="popup-show" value="html">
												</td>
											</tr>



											<tr class="for-type-2">
												<td colspan="3" class="for-url">
													<strong>URL: </strong>
													<input type="text" name="url-popup" maxlength="255" style="width:500px" value="<?php echo (isset($edit['popup']['url'])) ? $edit['popup']['url'] : ''  ?>">
												</td>

												<td colspan="3" class="hide for-html">
													<strong>Codigo: </strong>
													<br>
													<textarea name="html-popup" style="width:80%;height:100px"><?php echo (isset($edit['popup']['html'])) ? $edit['popup']['html'] : ''  ?></textarea>
												</td>
											</tr>






											<tr class="for-type-3">
												<td colspan="3">
													<strong>Position: </strong>
													Bottom: <input type="radio" name="position" value="bottom" checked>
													Top: <input type="radio" name="position" value="top"  <?php echo ($edit['popup']['position'] == 'top') ? 'checked' : ''  ?>>
												</td>
											</tr>



											<tr class="for-type-3">
												<td colspan="3" class="for-url">
													<strong>Image click? : </strong>
													Yes: <input type="radio" name="image-click" class="image-click" value="1" checked>
													No: <input type="radio" name="image-click" class="image-click" value="0" <?php echo ($edit['popup']['click'] == false) ? 'checked' : ''  ?>>
													<br>
													<div class="for-click-true">
													<strong>URL: </strong> <input type="text" name="image-click-url" maxlength="255" style="width:500px" value="<?php echo (isset($edit['popup']['image-click-url'])) ? $edit['popup']['image-click-url'] : ''  ?>">
													</div>

												</td>


											</tr>

											<tr class="for-type-3">
												<td colspan="3">
													<strong>Title: </strong>
													<input type="text" name="title" style="width:500px" value="<?php echo (isset($edit['popup']['title'])) ? $edit['popup']['title'] : ''  ?>">
												</td>
											</tr>

											<tr class="for-type-3">
												<td colspan="3" >
													<strong>Description: </strong>
													<br>
													<textarea name="description" style="width:100%;height:50px"><?php echo (isset($edit['popup']['description'])) ? $edit['popup']['description'] : ''  ?></textarea>
												</td>
											</tr>


											<tr class="for-type-3">
												<td colspan="3" class="for-url">
													<strong>Button: </strong>
													<br>Text: <input type="text" name="button-text" maxlength="255" style="width:500px" value="<?php echo (isset($edit['popup']['button']['text'])) ? $edit['popup']['button']['text'] : ''  ?>">
													<br>URL: <input type="text" name="button-url" maxlength="255" style="width:500px" value="<?php echo (isset($edit['popup']['button']['url'])) ? $edit['popup']['button']['url'] : ''  ?>">
													<br>Background color: <input type="text" name="button-background" id="picker-bg" style="width:500px" value="<?php echo (isset($edit['popup']['button']['background'])) ? $edit['popup']['button']['background'] : ''  ?>">
													<br>Text color: <input type="text" name="button-color" id="picker-color" style="width:500px" value="<?php echo (isset($edit['popup']['button']['color'])) ? $edit['popup']['button']['color'] : ''  ?>">
												</td>
											</tr>



										</tbody>

									</table>
									<table class="form-table nav-tab-contents" id='avp_unicode_charkbd_admin_menu_panel_3' style='display: none;'>


										<tbody>
											<tr valign="top" class="even">
												<td>
													<textarea id="wp_retarger_pixel" name="wp_retarger_pixel" rows="5" cols="80"><?= $edit[ 'pixel'] ?></textarea>
												</td>
											</tr>
										</tbody>

									</table>
									<p>
										<input class="button-primary" type="submit" name="wp_retarger_username_submit" value="Guardar" />
									</p>
									<?php if(isset($edit[ 'ID'])){  ?>
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="id" value="<?= $edit['ID'] ?>">
									<input type="hidden" id="type" value="<?= $edit['type'] ?>">
									<input type="hidden" id="type-show" value="<?= $edit['popup']['show'] ?>">
									<?php } else { ?>
									<input type="hidden" name="action" value="create">
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
							<span><?php esc_attr_e('Sidebar Content Header', 'wp_admin_style'); ?></span>
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