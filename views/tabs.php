
<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h2><?php esc_attr_e( 'Herramientas de Remarketing', 'wp_admin_style' ); ?></h2>

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
										title="Click to change display to Braille"> Ruta </a> <a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_1"
										href="javascript:void( 0 );"
										title="Click to change display to Common"> Redirección de Imágen</a>
									<a class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_2"
										href="javascript:void( 0 );"
										title="Click to change display to Computers"> Popup </a> <a
										class="nav-tab" rel="avp_unicode_charkbd_admin_menu_panel_3"
										href="javascript:void( 0 );"
										title="Click to change display to Dingbats"> Pixel </a>
								</h3>
								<!-- Nav tabs -->
								<form name="wp_retarger_form" method="post" class="form-horizontal" role="form" action="?page=wp_retarger" enctype="multipart/form-data">

								    <div class="nav-tab-contents m-t-20" id='avp_unicode_charkbd_admin_menu_panel_0'>									
                                        <div class="form-group">
                                            <label for="name_router" class="col-sm-3 control-label">Nombre</label>
                                            <div class="col-sm-7">
                                            	<input type="text" id="name_router" name="name_router" class="form-control" value="<?= $edit['name_router'] ?>" />										
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="urlembed_router" class="col-sm-3 control-label">Url Embebida</label>
                                            <div class="col-sm-7">
                                				<input type="text" id="urlembed_router" name="urlembed_router" class="form-control" value="<?= $edit['urlembed_router'] ?>" />
										    </div>
                                        </div>
                                    </div> 

                                    <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_1' style='display: none;'>
                                   
                                        <div class="form-group">
                                            <label for="url_image_redirect" class="col-sm-3 control-label">Imagen de la Url</label>
                                            <div class="col-sm-7">
                                    			<input type="text" id="url_image_redirect" name="url_image_redirect" class="form-control" value="<?php echo (isset($edit['popup']['image'])) ? $edit['popup']['image'] : ''  ?>"/>
												<input type="file" name="picture" id="picture">
									        </div>
                                        </div>
                                     
                                        <div class="form-group">
                                            <label for="url_image_redirect_description" class="col-sm-3 control-label">Descripción</label>
                                            <div class="col-sm-7">
											     <input type="text" id="url_image_redirect_description" name="url_image_redirect_description" class="form-control" />
                                            </div>
                                        </div>
                                     
                                    </div>									
                                    
                                    
                                    <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_2' style='display: none;'>
                                        <table class="form-table" >
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
    											
    									   </tbody>
    									</table>
											
                                        <div class="form-group">
                                            <div class="for-type-2">
                                                <label for="popup-width" class="col-sm-3 control-label">Ancho</label>
                                                
                                                <div class="col-sm-7">
    													<input type="text" name="popup-width" class="form-control" value="<?php echo (isset($edit['popup']['width'])) ? $edit['popup']['width'] : '800'  ?>" maxlength="4" style="width:50px">px
                                                </div>                                            
                                            </div>
                                            <div class="for-type-2">
                                                <label for="popup-height" class="col-sm-3 control-label">Alto</label>
                                                
                                                <div class="col-sm-7">
    										    	<input type="text" name="popup-height" class="form-control" value="<?php echo (isset($edit['popup']['height'])) ? $edit['popup']['height'] : '600'  ?>" maxlength="4" style="width:50px">px
                                                </div>                                            
                                            </div>
                                            
                                            
                                            
                                            <div class="for-type-2">
                                                <label for="url_image_redirect" class="col-sm-3 control-label">Tipo de Popup:</label>
                                                <div class="col-sm-7">
													Por Url: <input type="radio" class="popup-show" name="popup-show" value="url" checked>
													Por HTML: <input type="radio" class="popup-show html" name="popup-show" value="html">
                                                </div>
                                            
                                            </div>
                            
                                            <div class="for-type-2 for-url">
                                                <label for="url-popup" class="col-sm-3 control-label">URL:</label>
                                                <div class="col-sm-7">
													<input type="text" name="url-popup" maxlength="255" class="form-control" value="<?php echo (isset($edit['popup']['url'])) ? $edit['popup']['url'] : ''  ?>">
                                               </div>

                                            </div>
                    
                                            <div class="for-type-2 hide for-html">
                                                <label for="url-popup" class="col-sm-3 control-label">Código:</label>
                                                <div class="col-sm-9">
                                                    <textarea name="html-popup" class="form-control" rows=5 cols="80"><?php echo (isset($edit['popup']['html'])) ? $edit['popup']['html'] : ''  ?></textarea>
				                                </div>
                                            
                                            </div>
                                            
                                            
                                            <div class="for-type-3">
                                                <label for="position" class="col-sm-3 control-label">Posición:</label>
                                                <div class="col-sm-7">
													Abajo: <input type="radio" name="position" value="bottom" checked>
													Arriba: <input type="radio" name="position" value="top"  <?php echo ($edit['popup']['position'] == 'top') ? 'checked' : ''  ?>>
									
                                               </div>

                                            </div>
                                            
                                            <div class="for-type-3 for-url">
                                                <label for="image-click" class="col-sm-3 control-label">Click en la Imagen?:</label>
                                                <div class="col-sm-7">
													Sí: <input type="radio" name="image-click" class="form-control image-click" value="1" checked>
													No: <input type="radio" name="image-click" class="form-control image-click" value="0" <?php echo ($edit['popup']['click'] == false) ? 'checked' : ''  ?>>
													<br>
													<div class="for-click-true">
													<strong>URL: </strong> <input type="text" name="image-click-url" maxlength="255" style="width:500px" value="<?php echo (isset($edit['popup']['image-click-url'])) ? $edit['popup']['image-click-url'] : ''  ?>">
													</div>
                                               </div>

                                            </div>


                                            <div class="for-type-3">
                                                <label for="title" class="col-sm-3 control-label">Título:</label>
                                                <div class="col-sm-7">
													<input type="text" name="title" class="form-control" value="<?php echo (isset($edit['popup']['title'])) ? $edit['popup']['title'] : ''  ?>">
                                               </div>

                                            </div>
								
                                            <div class="for-type-3">
                                                <label for="description" class="col-sm-3 control-label">Descripción:</label>
                                                <div class="col-sm-9">
													<textarea name="description" rows="5" cols="80" class="form-control"><?php echo (isset($edit['popup']['description'])) ? $edit['popup']['description'] : ''  ?></textarea>
								              </div>

                                            </div>

								
                                            <div class="for-type-3 for-url">
                                                <label for="button-text" class="col-sm-3 control-label">Botón:</label>
                                                <div class="col-sm-7">
													<br>Texto: <input type="text" name="button-text" maxlength="255" class="form-control" value="<?php echo (isset($edit['popup']['button']['text'])) ? $edit['popup']['button']['text'] : ''  ?>">
													<br>URL: <input type="text" name="button-url" maxlength="255" style="width:500px" value="<?php echo (isset($edit['popup']['button']['url'])) ? $edit['popup']['button']['url'] : ''  ?>">
													<br>Color de Fondo: <input type="text" name="button-background" id="picker-bg" style="width:500px" value="<?php echo (isset($edit['popup']['button']['background'])) ? $edit['popup']['button']['background'] : ''  ?>">
													<br>Color del Texto : <input type="text" name="button-color" id="picker-color" style="width:500px" value="<?php echo (isset($edit['popup']['button']['color'])) ? $edit['popup']['button']['color'] : ''  ?>">
                                                </div>

                                            </div>
                    					                        
                                        </div>
                            
					                                        
                                   </div>  
							
					
								    <div class="nav-tab-contents  m-t-20" id='avp_unicode_charkbd_admin_menu_panel_3' style='display: none;'>
                                   
                                        <div class="form-group">
                                            <div class="col-sm-9">
                       					        <textarea id="wp_retarger_pixel" name="wp_retarger_pixel" rows="5" cols="80" class="form-control"><?= $edit[ 'pixel'] ?></textarea>							
									        </div>
                                        </div>
                                     </div>
                                     
									<p>
										<input class="btn btn-primary" type="submit" name="wp_retarger_username_submit" value="Guardar" />
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

	

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div>
<!-- .wrap -->