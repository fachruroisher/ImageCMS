<div style="margin-top: 5px;">
    {if $CI->session->userdata('shopForCompare')}
        <a href="{shop_url('compare')}" rel="nofollow">
            <span class="icon-comprasion"></span>
            {lang('s_list_comp')}
        </a> 
        <span id="compareCount">({count($CI->session->userdata('shopForCompare'))})</span>
    {else:}
        <span class="c_97">
            <span class="icon-comprasion"></span>
            {lang('s_list_comp')}
            <span id="compareCount">(0)</span>
        </span>
    {/if}
</div>