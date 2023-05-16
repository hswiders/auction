<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>
<?php 
$total = count($pager->links());

foreach ($pager->links() as $link) 
{ 
	if ($link['active']) {
		$curr = $link['title'];
	}
	  
}

?>
				
<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pagination">
		<?php if ($pager->hasPrevious()) : ?>
			<li class="page-item">
				<a class="page-link" href="javascript:;" aria-label="<?= lang('Pager.first') ?>" data-ci-pagination-page="1">
					<span aria-hidden="true"><?= lang('Pager.first') ?></span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="javascript:;" aria-label="<?= lang('Pager.previous') ?>" data-ci-pagination-page="<?= $curr -1 ?>">
					<span aria-hidden="true"><?= lang('Pager.previous') ?></span>
				</a>
			</li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : 
			if ($pager->getPageCount() == 1) {
				continue;
			}?>
			<li  <?= $link['active'] ? 'class="active page-item"' : 'class="page-item"' ?>>
				<a class="page-link" href="javascript:;" <?= $link['active'] ? '' : 'data-ci-pagination-page="'.$link['title'].'"' ?>>
					<?= $link['title'] ?>
				</a>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
			<li class="page-item">
				<a class="page-link" href="javascript:;" aria-label="<?= lang('Pager.next') ?>" data-ci-pagination-page="<?= $curr + 1 ?>">
					<span aria-hidden="true"><?= lang('Pager.next') ?></span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="javascript:;" aria-label="<?= lang('Pager.last') ?>" data-ci-pagination-page="<?= $total +1 ?>">
					<span aria-hidden="true"><?= lang('Pager.last') ?></span>
				</a>
			</li>
		<?php endif ?>
	</ul>
</nav>
