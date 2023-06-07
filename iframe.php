<div><?php
    $html = file_get_contents("http://scp-zh-tr.wikidot.com/scp-682");
    $html = explode('<div id="page-content">', $html)[1];
    $html = explode('<div class="footer-wikiwalk-nav">', $html)[0];
    $html = explode('</div>', $html);
    $html = $html[count($html)-1];
    $html = explode('</p>', $html);
    $html = array_slice($html, 2);
    $html = implode('</p>', $html);
    echo $html;
?></div>