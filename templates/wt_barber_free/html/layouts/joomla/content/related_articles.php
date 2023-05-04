
<?php
defined ('JPATH_BASE') or die();
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;
$articles = $displayData['articles'];
$mainItem = $displayData['item'];

$tmpl_params = JFactory::getApplication()->getTemplate(true)->params;

?>
<div class="related-article-list-container uk-margin-medium-top">
    <h3 class="uk-h3 uk-heading-bullet"> <?php echo $tmpl_params->get('related_article_title'); ?> </h3>
    <?php if( $tmpl_params->get('related_article_view_type') == 'thumb' ): ?>
    <div class="article-list related-article-list">
        <div class="uk-child-width-1-1 uk-grid-medium uk-grid-divider uk-grid-match" uk-grid>
            <?php foreach( $articles as $item ): ?>
                <div>
                <?php echo LayoutHelper::render('joomla.content.related_article', $item); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if( $tmpl_params->get('related_article_view_type') == 'list' ): ?>
        <ul class="uk-list uk-list-divider">
        <?php foreach( $articles as $item ): ?>
            <li>
            <h3 property="headline" class="el-title uk-h5 uk-margin-remove-bottom">
            <a class="uk-link-reset" href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
						<?php echo $this->escape($item->title); ?>
			</a>
            </h3>
            <p class="el-meta uk-text-muted uk-margin-small-top"><?php echo JLayoutHelper::render('joomla.content.info_block.publish_date', array('item' => $item, 'params' => $item->params,'articleView'=>'intro')); ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
 