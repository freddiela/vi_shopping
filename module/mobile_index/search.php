<?php
/**
 * @copyright   2015-2019 逍遥商城 <http://www.qiye1000.com>
 * @creatdate   2012-0501 myllop <myllop@gmail.com>
 */
 
$info_list = pe_getcookie('keyword_list', 'array');

$seo = pe_seo();
include(pe_tpl('search.html'));
?>