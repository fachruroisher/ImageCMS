<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Список пользователей подписаных на товары</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
            </div>
        </div>                            
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>№</th>
                <th>Пользователь</th>
                <th>Отписать</th>
                <th>Товар</th>
                <th>Новая цена</th>
                <th>Старая цена</th>
                <th>Процент снижения цены</th>
            </tr>
        </thead>
        <tbody>
            {foreach $spys as $key => $product}
                <tr id='{echo $product->hash}'>
                    <td>{echo $key+1}</td>
                    <td>{echo $product->username}</td>
                    <td>
                        <input type="submit" 
                               class="btn my_btn_s btn-small pull-left btn-danger m-r_5" 
                               value="Отписать"
                               onclick="unspy({echo $product->hash})"/>
                    </td>
                    <td>
                        <a href="{shop_url($product->url)}" 
                           title="{echo $product->name}">
                            {echo $product->name}
                        </a>
                    </td>
                    <td>{echo round($product->productPrice, ShopCore::app()->SSettings->pricePrecision)}</td>
                    <td>{echo round($product->oldProductPrice, ShopCore::app()->SSettings->pricePrecision)}</td>
                    <td>{echo round(($product->productPrice-$product->oldProductPrice)*100/$product->oldProductPrice, 2)} %</td>
                </tr>
            {/foreach}
        </tbody>
    </table>

</section>