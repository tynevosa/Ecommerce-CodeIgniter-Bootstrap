<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(count($sliderArticles) > 0) {
?>
<div id="home-slider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  <?php
  $i = 0;
    while ($i < count($sliderArticles)) {
	?>
    <li data-target="#home-slider" data-slide-to="0" class="<?= $i==0 ? 'active' : '' ?>"></li>
	<?php $i++;} ?>
  </ol>
  
<div class="container">
  <div class="carousel-inner" role="listbox">
  <?php $i=0; foreach($sliderArticles as $article) { ?>
    <div class="item <?= $i == 0 ? 'active':'' ?>">
	<div class="row">
		<div class="col-sm-6 left-side">
			<img src="<?= base_url('attachments/shop_images/'.$article['image']) ?>" class="img-responsive" alt="">
		</div>
		<div class="col-sm-6 right-side">
			<h3 class="text-right"><?= $article['title'] ?></h3>
			<div class="description text-right">
				<?= $article['basic_description'] ?>
			</div>
			<div class="price text-right"><?= $article['price'].$currency ?></div>
			<div class="xs-center"><a class="buy-now" href="<?=  base_url($article['url']) ?>"><span class="glyphicon glyphicon-shopping-cart"></span> <?= lang('buy_now') ?></a></div>
		</div>
    </div>
	 </div>
	 <?php $i++; } ?>
  </div>
  </div>
  <a class="left carousel-control" href="#home-slider" role="button" data-slide="prev"></a>
  <a class="right carousel-control" href="#home-slider" role="button" data-slide="next"></a>
</div>
<?php } ?>
<div class="container" id="home-page">
    <div class="row">
        <div class="col-md-3">
            <div class="filter-sidebar">
                <div class="title">
                    <span><?= lang('categories') ?></span>
					<?php if(isset($_GET['category']) && $_GET['category'] != '') { ?>
					<a href="javascript:void(0);" class="clear-filter" data-type-clear="category" data-toggle="tooltip" data-placement="right" title="<?= lang('clear_the_filter') ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
					<?php } ?>
				</div>
                <?php
                function loop_tree($pages, $is_recursion = false) {
                    ?>
                    <ul class="<?= $is_recursion === true ? 'children' : 'parent' ?>">
                        <?php
                        foreach ($pages as $page) {
                            $children = false;
                            if (isset($page['children']) && !empty($page['children'])) {
                                $children = true;
                            }
                            ?>
                            <li>
                                <?php if ($children === true) {
                                    ?>
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <?php } else { ?>
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>
                                <?php } ?>
                                <a href="javascript:void(0);" data-categorie-id="<?= $page['id'] ?>" class="go-category <?= isset($_GET['category']) && $_GET['category'] == $page['id'] ? 'selected' : '' ?>"><?= $page['name'] ?></a>
                                <?php
                                if ($children === true) {
                                    loop_tree($page['children'], true);
                                } else {
                                    ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <?php
                    if ($is_recursion === true) {
                        ?>
                        </li>
                        <?php
                    }
                }
                loop_tree($home_categories);
                ?>
            </div>
            <div class="filter-sidebar">
                <div class="title">
                    <span><?= lang('store') ?></span>
					<?php if(isset($_GET['in_stock']) && $_GET['in_stock'] != '') { ?>
					<a href="javascript:void(0);" class="clear-filter" data-type-clear="in_stock" data-toggle="tooltip" data-placement="right" title="<?= lang('clear_the_filter') ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
					<?php } ?>
				</div>
                <ul>
                    <li>
                        <a href="javascript:void(0);" data-in-stock="1" class="in-stock <?= isset($_GET['in_stock']) && $_GET['in_stock'] == '1' ? 'selected' : '' ?>"><?= lang('in_stock') ?> (<?= $countQuantities['in_stock'] ?>)</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-in-stock="0" class="in-stock <?= isset($_GET['in_stock']) && $_GET['in_stock'] == '0' ? 'selected' : '' ?>"><?= lang('out_of_stock') ?> (<?= $countQuantities['out_of_stock'] ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9" id="products-side">
            <div class="alone title">
                <span><?= lang('products') ?></span>
            </div>
            <div class="product-sort">
<div class="row">
  <div class="ord col-sm-4">
    <div class="form-group">
                <select class="selectpicker order form-control" data-order-to="order_new">
                    <option <?= isset($_GET['order_new']) && $_GET['order_new'] == "desc" ? 'selected' : '' ?> <?= !isset($_GET['order_new']) || $_GET['order_new'] == "" ? 'selected' : '' ?> value="desc"><?= lang('new') ?> </option>
                    <option <?= isset($_GET['order_new']) && $_GET['order_new'] == "asc" ? 'selected' : '' ?> value="asc"><?= lang('old') ?> </option>
                </select>
				</div>
				  </div>
				  <div class="ord col-sm-4">
    <div class="form-group">
                <select class="selectpicker order form-control" data-order-to="order_price" title="<?= lang('price_title') ?>..">
					<option></option>
                    <option <?= isset($_GET['order_price']) && $_GET['order_price'] == "desc" ? 'selected' : '' ?> value="desc"><?= lang('price_low') ?> </option>
                    <option <?= isset($_GET['order_price']) && $_GET['order_price'] == "asc" ? 'selected' : '' ?> value="asc"><?= lang('price_high') ?> </option>
                </select>
				</div>
				  </div>
				  <div class="ord col-sm-4">
    <div class="form-group">
                <select class="selectpicker order form-control" data-order-to="order_procurement" title="<?= lang('procurement_title') ?>..">
				    <option></option>
                    <option <?= isset($_GET['order_procurement']) && $_GET['order_procurement'] == "desc" ? 'selected' : '' ?> value="desc"><?= lang('procurement_desc') ?> </option>
                    <option <?= isset($_GET['order_procurement']) && $_GET['order_procurement'] == "asc" ? 'selected' : '' ?> value="asc"><?= lang('procurement_asc') ?> </option>
                </select>
				 </div>
				  </div>
				   </div>
            </div>
            <?php if(!empty($shop_articles)) {
				loop_articles($shop_articles, $currency, 'col-sm-4 col-md-3');
			} else {
				?>
				<script>
				$(document).ready(function() {ShowNotificator('alert-danger', '<?= lang('no_results') ?>');});
				</script>
				<?php
			}				
			echo $links_pagination ;
			?>
        </div>
    </div>
</div>