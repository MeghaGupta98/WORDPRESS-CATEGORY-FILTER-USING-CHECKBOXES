<?php 
	/* Template Name: Shop page template */
	get_header();
?>

<link rel='stylesheet' id='parent-style-2-css' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' type='text/css' media='all' />
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>

<style type="text/css">
  .loader {
    border: 10px solid #f3f3f3;
    border-top: 10px solid #294466;
    border-radius: 50%;
    width: 90px;
    height: 90px;
    animation: spin 2s linear infinite;
    margin: 100px auto;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

.price-range-slider {
  width: 100%;
  padding-bottom: 30px;
}
.price-range-slider .range-value {
  margin: 0;
}
.price-range-slider .range-value input {
  width: 100%;
  background: none;
  color: #000;
  font-size: 22px;
  font-weight: initial;
  box-shadow: none;
  border: none;
  margin: 20px 0 20px 0;
   font-family: 'Nunito', sans-serif;
}
.price-range-slider .range-bar {
  border: none;
  background: #000;
  height: 3px;
  width: 96%;
  margin-left: 8px;
}
.price-range-slider .range-bar .ui-slider-range {
  background: #ddbb79;
}
.price-range-slider .range-bar .ui-slider-handle {
  border: none;
  border-radius: 25px;
  background: #ddbb79;
  border: 2px solid #090a0a;
  height: 17px;
  width: 17px;
  top: -0.52em;
  cursor: pointer;
}
.price-range-slider .range-bar .ui-slider-handle + span {
  background: #ddbb79;
}

/*--- /.price-range-slider ---*/

.cvf-pagination-nav {
    width: 100%;
}
.cvf-pagination-nav .cvf-universal-pagination ul {
    display: flex;
    justify-content: center;
    width: 100%;
    gap: 20px;
}
.cvf-pagination-nav .cvf-universal-pagination li {
    padding: 18px !important;
    color: #000;
    font-family: 'Inter', sans-serif;
    border: 1px solid lightgray;
    cursor: pointer;
}
.cvf-pagination-nav {
    padding-bottom: 35px;
}
.cvf-pagination-nav .cvf-universal-pagination li.selected {
    background: #ddbb79;
}
@media only screen and (max-width: 767px){
.cvf-pagination-nav .cvf-universal-pagination li {
    padding: 5px !important;
    color: #000;
    font-family: 'Inter', sans-serif;
    border: 1px solid lightgray;
    cursor: pointer;
    font-size: 13px;
}
.cvf-pagination-nav .cvf-universal-pagination ul {
    display: flex;
    justify-content: center;
    width: 100%;
    gap: 10px;
}
}
</style>
  <div class="container-template">
    
    <div class="shop_section">
         <div class="left_side_bar">
           
            <div class="card_list_items">
               <h3>Product Categories</h3>
               <ul>
               <?php
                 $taxonomy     = 'product_cat';
                 $orderby      = 'name';  
                 $show_count   = 0;      // 1 for yes, 0 for no
                 $pad_counts   = 0;      // 1 for yes, 0 for no
                 $hierarchical = 1;      // 1 for yes, 0 for no  
                 $title        = '';  
                 $empty        = 0;

                 $args = array(
                        'taxonomy'     => $taxonomy,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty
                 );
                $all_categories = get_categories( $args );
                foreach ($all_categories as $cat) {
                   if($cat->category_parent == 0) {
                       $category_id = $cat->term_id;   ?>    
                       <!-- echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';  -->
                       <li>
                           <input type="checkbox" name="" class="category" id="<?php echo $category_id; ?>" value="<?php echo $category_id; ?>">
                           <label for="<?php echo $category_id; ?>"><?php echo $cat->name; ?></label>
                        </li>
                  <?php }       
               }
               ?>          
               </ul>
               <ul>
                  <li class="border-top pt-3">
                     <input type="checkbox" name="" class="onsale" value="sale">
                     <label>On sale</label>
                  </li>
                  <li class="border-bottom">
                     <input type="checkbox" name="" class="stock" value="stock">
                     <label>In stock</label>
                  </li>
                  <li>
               </ul>
            </div>
            <div class="price-range-slider">
  
              <p class="range-value">
                <input type="text" id="amount" readonly>
                <input type="hidden" id="pmin">
                <input type="hidden" id="pmax">
              </p>
              <div id="slider-range" class="range-bar"></div>
              
            </div>
         </div>
         <div class="right_side_bar">
            <div class="filter_right">
               <!-- <p class="result-count">Showing <span>19–27</span> of <span>379</span> results</p> -->
               <p class="result-count"><span class="tot"></span> results</p>

              <div class="right_toggle_side">
               <div class="toggle_mobile_left_bar" style="display: none;">
               <img src="/wp-content/uploads/2022/12/filterr.png">
               </div>

               <div class="sort_filter">
                  <select name="orderby" class="orderby3" aria-label="Shop order">
                     <option value="" selected="selected">Default sorting</option>
                     <option value="popularity">Sort by popularity</option>
                     <!-- <option value="rating">Sort by average rating</option> -->
                     <option value="date">Sort by latest</option>
                     <option value="price-asc">Sort by price: low to high</option>
                     <option value="price-desc">Sort by price: high to low</option>
                  </select>
               </div>
            </div>
            </div>
            <div class="loader"></div>
            <div class="product_card_row" id="list-row">
               <!-- <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image31800909824206-300x300.png">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image-28354429255886-300x300.jpg">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image-29324604047566-300x300.jpg">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image-28354429255886-300x300.jpg">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image-29324604047566-300x300.jpg">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image-28354429255886-300x300.jpg">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image29328415260878.png">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image-29310730010830-300x300.jpg">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div>
               <div class="card_prdcts">
                  <div class="img_crd">
                     <img src="https://chosenelevations.atxclients.com/wp-content/uploads/2022/11/wp-image29380509008078-300x300.png">
                     <button><a href="#">Add To Card</a></button>
                  </div>
                  <div class="crd_text">
                     <h5>A Girl & Her Pearls "MAJESTY"</h5>
                     <p class="rate_prdct">$5.00</p>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
      </div>

<?php get_footer(); ?>
<script type="text/javascript">
   jQuery(document).ready(function() {
      var page = 1;
      $( "#slider-range" ).slider({
         range: true,
         min: 0,
         max: 2000,
         values: [ 0, 500 ],
         slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            $( "#pmin" ).val(ui.values[ 0 ]);
            $( "#pmax" ).val(ui.values[ 1 ]); 
         },
         stop: function( event, ui ) {
            ajaxCall(page)        
         }
      });
      $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );

      $( "#pmin" ).val($( "#slider-range" ).slider( "values", 0 ));
      $( "#pmax" ).val($( "#slider-range" ).slider( "values", 1 )); 

      var data = {
         action: 'filter_data',
      };
      function ajaxCall(page) {
         var category = [];
         jQuery('#list-row').html("");
         jQuery('.loader').show();
         $(".category:checkbox:checked").each(function() {
            const val = $(this).val()
            category.push(val)
         })
         data.category = category;
         data.onsale = $('.onsale').is(':checked') ? 'yes': 'no';
         data.stock = $('.stock').is(':checked') ? 'yes': 'no';
         data.price_min = $( "#pmin" ).val();
         data.price_max = $( "#pmax" ).val();
         data.page = page;
         data.orderby = $( ".orderby3" ).val();

         jQuery.ajax({
            type: "post",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: data,
            success: function(response) {            
               jQuery('.loader').hide();
               jQuery('#list-row').html(response);
               setTimeout(() => {
                  jQuery('.result-count .tot').text(jQuery('#cnt').val());
               }, 1000)
            }
         });
      }

      ajaxCall(page)

      $('.category, .onsale, .stock').on('click', function() {
         ajaxCall(page);
      })
      $('.orderby3').on('change', function() {
         ajaxCall(page);
      })

      jQuery(document).on('click', '.cvf-universal-pagination li.active', function(){
         page = jQuery(this).attr('p');
         ajaxCall(page);
      });

      
   });
</script>

<script >
$(document).ready(function(){
   console.log("hello");
  $(".toggle_mobile_left_bar").click(function(){
    $(".left_side_bar").toggleClass("slide");
  });
   });
</script>