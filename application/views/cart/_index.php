          
            <div id="block_content"><!-- block_content //-->     
            	<h2 class="nav_title">Giỏ Hàng</h2>                
                <div id="ru-content" style="padding:5px;width: 625px;">
               	<?php $this->load->view('cart/cart')?>
				<?php  if(count($cart) != 0) $this->load->view('cart/checkout')?>
                </div>
            </div><!-- #block_content //-->
        </div><!--- #top //-->   