<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Site Map", 'sitemap')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'sitemap')}</span></a>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_changefreq_form" data-submit><i class="icon-ok"></i>{lang("Save", 'sitemap')}</button>
                <button type="button" class="btn btn-small btn-success formSubmit" data-form="#sitemap_changefreq_form" data-action="show_sitemap" data-submit><i class="icon-share"></i>{lang("Save and view", 'sitemap')}</button>
                <span class="btn-group">
                    <button type="button" class="btn btn-small btn-info dropdown-toggle" data-toggle="dropdown" style="margin-top: -5px;">
                        <i class="icon-white icon-list"></i>
                        {lang('Others', 'sitemap')}<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/priorities">{lang('Priorities', 'sitemap')}</a></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/changefreq">{lang('Change frequency', 'sitemap')}</a></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/blockedUrls">{lang('Block urls', 'sitemap')}</a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" href="{site_url('sitemap.xml')}" target="_blank">{lang("View Site Map", 'sitemap')}</a></li>
                        <li class="divider"></li>
                        <li><a style="text-decoration: none" class="pjax" href="/admin/components/init_window/sitemap/settings">{lang('Settings', 'sitemap')}</a></li>
                    </ul>
                </span>
            </div>
        </div>                            
    </div>
    <form action="/admin/components/cp/sitemap/changefreq" id="sitemap_changefreq_form" method="post" class="form-horizontal">
        <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
            <thead>
            <th>{lang("Page change frequency", 'sitemap')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="inside_padd span9">
                            <div class="control-group">
                                <label class="control-label">{lang("Main page", 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('main_page_changefreq', $changefreq_options, $main_page_changefreq)}
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sppri">{lang("Regular or usual pages", 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('pages_changefreq', $changefreq_options, $pages_changefreq)}
                                </div>
                            </div>    

                            <div class="control-group">
                                <label class="control-label">{lang("Categories pages", 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('categories_changefreq', $changefreq_options, $categories_changefreq)}
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sppri">{lang('Sub categories pages', 'sitemap')}:</label>
                                <div class="controls">
                                    {form_dropdown('sub_categories_changefreq', $changefreq_options, $sub_categories_changefreq)}
                                </div>
                            </div>

                            {if SHOP_INSTALLED}

                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang('Products page', 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('product_changefreq', $changefreq_options, $product_changefreq)}
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">{lang("Products categories pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('products_categories_changefreq', $changefreq_options, $products_categories_changefreq)}
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">{lang("Products sub categories pages", 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('products_sub_categories_changefreq', $changefreq_options, $products_sub_categories_changefreq)}
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="sppri">{lang('Brands pages', 'sitemap')}:</label>
                                    <div class="controls">
                                        {form_dropdown('brands_changefreq', $changefreq_options, $brands_changefreq)}
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>